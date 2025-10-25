@php
    $stats = $stats ?? getVisitStats();
@endphp

<div class="col-lg-3 col-md-6 col-12">
    <!-- Card de Estatísticas de Visitas -->
    <div class="small-box bg-gradient-info shadow-sm">
        <div class="inner">
            <!-- Número Principal -->
            <h3 class="mb-2">
                {{ number_format($stats['total'] ?? 0, 0, ',', '.') }}
                <sup style="font-size: 20px">visitas</sup>
            </h3>
            
            <p class="mb-3" style="font-size: 16px; font-weight: 500;">
                <i class="fas fa-globe-americas mr-1"></i>
                Total de Acessos
            </p>
            
            <!-- Estatísticas Detalhadas -->
            <div class="stats-detail" style="background: rgba(255,255,255,0.15); border-radius: 5px; padding: 10px; margin-top: 15px;">
                <div class="row text-center">
                    <div class="col-4">
                        <div class="stat-item">
                            <i class="fas fa-calendar-day" style="font-size: 16px; opacity: 0.8;"></i>
                            <div style="font-size: 18px; font-weight: bold; margin-top: 5px;">
                                {{ number_format($stats['today'] ?? 0, 0, ',', '.') }}
                            </div>
                            <small style="font-size: 11px; opacity: 0.9;">Hoje</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-item">
                            <i class="fas fa-calendar-week" style="font-size: 16px; opacity: 0.8;"></i>
                            <div style="font-size: 18px; font-weight: bold; margin-top: 5px;">
                                {{ number_format($stats['week'] ?? 0, 0, ',', '.') }}
                            </div>
                            <small style="font-size: 11px; opacity: 0.9;">Semana</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-item">
                            <i class="fas fa-calendar-alt" style="font-size: 16px; opacity: 0.8;"></i>
                            <div style="font-size: 18px; font-weight: bold; margin-top: 5px;">
                                {{ number_format($stats['month'] ?? 0, 0, ',', '.') }}
                            </div>
                            <small style="font-size: 11px; opacity: 0.9;">Mês</small>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Visitantes Únicos -->
            @if(isset($stats['unique']) && $stats['unique'] > 0)
            <div class="mt-2 pt-2" style="border-top: 1px solid rgba(255,255,255,0.2);">
                <small style="font-size: 12px; opacity: 0.95;">
                    <i class="fas fa-users mr-1"></i>
                    <strong>{{ number_format($stats['unique'], 0, ',', '.') }}</strong> visitantes únicos
                </small>
            </div>
            @endif
        </div>
        
        <!-- Ícone Grande -->
        <div class="icon">
            <i class="fas fa-chart-line"></i>
        </div>
        
        <!-- Link para mais informações (opcional) -->
        {{-- <a href="#" class="small-box-footer" style="background: rgba(0,0,0,0.1);">
            Ver detalhes 
            <i class="fas fa-arrow-circle-right ml-1"></i>
        </a> --}}
    </div>
</div>

<style>
    /* Animação suave para os números */
    .small-box .inner h3 {
        animation: fadeInUp 0.5s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Hover effect no card */
    .small-box {
        transition: all 0.3s ease;
    }
    
    .small-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2) !important;
    }
    
    /* Melhoria nos ícones das estatísticas */
    .stat-item {
        transition: all 0.2s ease;
    }
    
    .stat-item:hover {
        transform: scale(1.05);
    }
    
    /* Responsividade */
    @media (max-width: 768px) {
        .small-box .inner h3 {
            font-size: 2rem;
        }
        
        .stats-detail {
            padding: 8px !important;
        }
        
        .stat-item div {
            font-size: 16px !important;
        }
    }
</style>
