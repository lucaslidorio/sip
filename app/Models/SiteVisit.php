<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class SiteVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'page_url',
        'referer',
        'session_id',
        'visited_at'
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    /**
     * Registra uma nova visita
     */
    public static function registerVisit($request)
    {
        // Verifica se já existe uma visita desta sessão nos últimos 30 minutos
        $recentVisit = self::where('session_id', session()->getId())
            ->where('visited_at', '>', Carbon::now()->subMinutes(30))
            ->exists();

        if (!$recentVisit) {
            self::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'page_url' => $request->fullUrl(),
                'referer' => $request->header('referer'),
                'session_id' => session()->getId(),
                'visited_at' => Carbon::now(),
            ]);

            // Atualiza contador diário
            self::updateDailyCounter();
            
            // Limpa o cache das estatísticas
            self::clearStatsCache();
        }
    }

    /**
     * Atualiza o contador diário
     */
    public static function updateDailyCounter()
    {
        $today = Carbon::today();
        
        $visitsCount = self::whereDate('visited_at', $today)->count();
        $uniqueVisitors = self::whereDate('visited_at', $today)
            ->distinct('ip_address')
            ->count('ip_address');

        SiteVisitCounter::updateOrCreate(
            ['date' => $today],
            [
                'visits_count' => $visitsCount,
                'unique_visitors' => $uniqueVisitors
            ]
        );
    }

    /**
     * Retorna total de visitas
     */
    public static function getTotalVisits()
    {
        return self::count();
    }

    /**
     * Retorna visitas de hoje
     */
    public static function getTodayVisits()
    {
        return self::whereDate('visited_at', Carbon::today())->count();
    }

    /**
     * Retorna visitas desta semana
     */
    public static function getWeekVisits()
    {
        return self::whereBetween('visited_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
    }

    /**
     * Retorna visitas deste mês
     */
    public static function getMonthVisits()
    {
        return self::whereMonth('visited_at', Carbon::now()->month)
            ->whereYear('visited_at', Carbon::now()->year)
            ->count();
    }

    /**
     * Retorna visitantes únicos (por IP)
     */
    public static function getUniqueVisitors()
    {
        return self::distinct('ip_address')->count('ip_address');
    }

    /**
     * Retorna estatísticas completas COM CACHE (5 minutos)
     */
    public static function getStats()
    {
        return Cache::remember('site_visit_stats', 300, function () {
            return [
                'total' => self::getTotalVisits(),
                'today' => self::getTodayVisits(),
                'week' => self::getWeekVisits(),
                'month' => self::getMonthVisits(),
                'unique' => self::getUniqueVisitors(),
            ];
        });
    }
    
    /**
     * Limpa o cache das estatísticas
     */
    public static function clearStatsCache()
    {
        Cache::forget('site_visit_stats');
    }
}
