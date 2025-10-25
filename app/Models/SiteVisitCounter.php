<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SiteVisitCounter extends Model
{
    use HasFactory;

    protected $table = 'site_visits_counter';

    protected $fillable = [
        'date',
        'visits_count',
        'unique_visitors'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Retorna o contador de hoje
     */
    public static function getTodayCounter()
    {
        return self::whereDate('date', Carbon::today())->first();
    }

    /**
     * Retorna estatísticas dos últimos 30 dias
     */
    public static function getLast30Days()
    {
        return self::where('date', '>=', Carbon::now()->subDays(30))
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * Retorna total acumulado
     */
    public static function getTotalAccumulated()
    {
        return [
            'total_visits' => self::sum('visits_count'),
            'total_unique' => self::sum('unique_visitors'),
        ];
    }
}
