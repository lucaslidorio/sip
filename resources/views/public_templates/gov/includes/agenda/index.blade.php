@extends('public_templates.gov.layouts.app')

@section('title', 'Agenda Pública - ' . $tenant->nome)
@section('description', 'Acompanhe a agenda pública de eventos e compromissos de ' . $tenant->nome)

@section('content')
<div class="container section-padding">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('site.index') }}">
                    <i class="fas fa-home"></i> Início
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Agenda Pública
            </li>
        </ol>
    </nav>

    <!-- Cabeçalho da Página -->
    <div class="page-header text-center mb-5">
        <h1 class="page-title text-primary-color">
            <i class="fas fa-calendar me-3"></i>
            Agenda Pública
        </h1>
        <p class="page-subtitle text-muted">
            Acompanhe os eventos, reuniões e compromissos públicos da administração municipal
        </p>
    </div>

    <div class="row">
        <!-- Calendário Principal -->
        <div class="col-lg-8">
            <div class="calendar-container">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Calendário de Eventos
                            </h5>
                            <div class="calendar-controls">
                                <button class="btn btn-light btn-sm" id="prevMonth">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <span class="mx-3" id="currentMonth"></span>
                                <button class="btn btn-light btn-sm" id="nextMonth">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            <!-- Lista de Eventos do Dia -->
            <div class="events-today mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-clock me-2"></i>
                            Eventos de Hoje
                        </h5>
                    </div>
                    <div class="card-body" id="todayEvents">
                        <div class="text-center text-muted py-4">
                            <i class="fas fa-calendar-check fa-2x mb-3"></i>
                            <p>Nenhum evento programado para hoje</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="agenda-sidebar">
                <!-- Filtros -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Filtros</h3>
                    <form id="filterForm">
                        <div class="mb-3">
                            <label for="eventType" class="form-label">Tipo de Evento</label>
                            <select class="form-select" id="eventType">
                                <option value="">Todos os tipos</option>
                                <option value="reuniao">Reuniões</option>
                                <option value="audiencia">Audiências Públicas</option>
                                <option value="evento">Eventos</option>
                                <option value="sessao">Sessões</option>
                                <option value="outros">Outros</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="dateRange" class="form-label">Período</label>
                            <select class="form-select" id="dateRange">
                                <option value="all">Todos os períodos</option>
                                <option value="today">Hoje</option>
                                <option value="week">Esta semana</option>
                                <option value="month">Este mês</option>
                                <option value="next_month">Próximo mês</option>
                            </select>
                        </div>
                        
                        <button type="button" class="btn btn-primary w-100" onclick="applyFilters()">
                            <i class="fas fa-filter me-2"></i>
                            Aplicar Filtros
                        </button>
                    </form>
                </div>

                <!-- Próximos Eventos -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Próximos Eventos</h3>
                    <div id="upcomingEvents">
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-spinner fa-spin"></i>
                            <p class="mb-0">Carregando eventos...</p>
                        </div>
                    </div>
                </div>

                <!-- Legenda -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Legenda</h3>
                    <div class="legend-items">
                        <div class="legend-item mb-2">
                            <span class="legend-color bg-primary"></span>
                            <span class="legend-text">Reuniões</span>
                        </div>
                        <div class="legend-item mb-2">
                            <span class="legend-color bg-success"></span>
                            <span class="legend-text">Audiências Públicas</span>
                        </div>
                        <div class="legend-item mb-2">
                            <span class="legend-color bg-warning"></span>
                            <span class="legend-text">Eventos</span>
                        </div>
                        <div class="legend-item mb-2">
                            <span class="legend-color bg-info"></span>
                            <span class="legend-text">Sessões</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color bg-secondary"></span>
                            <span class="legend-text">Outros</span>
                        </div>
                    </div>
                </div>

                <!-- Informações -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Informações</h3>
                    <div class="info-content">
                        <p class="small text-muted mb-3">
                            Esta agenda apresenta os eventos públicos da administração municipal.
                        </p>
                        
                        <div class="contact-info">
                            @if($tenant->telefone)
                            <p class="mb-2">
                                <i class="fas fa-phone text-primary me-2"></i>
                                <a href="tel:{{ $tenant->telefone }}">{{ $tenant->telefone }}</a>
                            </p>
                            @endif
                            
                            @if($tenant->email)
                            <p class="mb-0">
                                <i class="fas fa-envelope text-primary me-2"></i>
                                <a href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a>
                            </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Acesso Rápido -->
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Acesso Rápido</h3>
                    <div class="d-grid gap-2">
                        <a href="{{ route('site.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i> Página Inicial
                        </a>
                        <a href="{{ route('site.noticias.todas') }}" class="btn btn-outline-primary">
                            <i class="fas fa-newspaper me-2"></i> Notícias
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-gavel me-2"></i> Licitações
                        </a>
                        <a href="#" class="btn btn-outline-primary">
                            <i class="fas fa-balance-scale me-2"></i> Transparência
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- Modal de Detalhes do Evento -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="eventModalBody">
                <!-- Conteúdo será carregado dinamicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
<style>
.calendar-container .card {
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--gray-200);
}

.page-header {
    padding: 2rem 0;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.page-subtitle {
    font-size: 1.25rem;
    max-width: 600px;
    margin: 0 auto;
}

.sidebar-widget {
    background: var(--bg-primary);
    border-radius: var(--border-radius-lg);
    padding: 1.5rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--gray-200);
}

.sidebar-widget-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-lighter);
}

.legend-item {
    display: flex;
    align-items: center;
}

.legend-color {
    width: 16px;
    height: 16px;
    border-radius: 50%;
    margin-right: 0.5rem;
}

.legend-text {
    font-size: 0.9rem;
}

.contact-info a {
    color: var(--text-primary);
    text-decoration: none;
}

.contact-info a:hover {
    color: var(--primary-color);
}

.event-item {
    border-left: 4px solid var(--primary-color);
    padding: 1rem;
    margin-bottom: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-md);
    transition: var(--transition-normal);
}

.event-item:hover {
    background: var(--primary-lighter);
    cursor: pointer;
}

.event-time {
    font-weight: 600;
    color: var(--primary-color);
}

.event-title {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.event-description {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

/* Customização do FullCalendar */
.fc {
    font-family: inherit;
}

.fc-event {
    border: none;
    border-radius: var(--border-radius-sm);
    padding: 2px 4px;
}

.fc-event-title {
    font-weight: 500;
}

.fc-daygrid-event {
    margin: 1px 0;
}

.fc-button-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.fc-button-primary:hover {
    background-color: var(--primary-dark);
    border-color: var(--primary-dark);
}

.fc-today-button {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
}

@media (max-width: 768px) {
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
    }
    
    .calendar-controls {
        font-size: 0.9rem;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/locales/pt-br.global.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    let calendar;
    
    // Inicializar calendário
    calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'pt-br',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listWeek'
        },
        height: 'auto',
        events: function(fetchInfo, successCallback, failureCallback) {
            // Carregar eventos via AJAX
            fetch('{{ route("site.agenda.show") }}')
                .then(response => response.json())
                .then(data => {
                    const events = data.map(event => ({
                        id: event.id,
                        title: event.titulo,
                        start: event.data_inicio,
                        end: event.data_fim,
                        description: event.descricao,
                        location: event.local,
                        backgroundColor: getEventColor(event.tipo),
                        borderColor: getEventColor(event.tipo),
                        extendedProps: {
                            tipo: event.tipo,
                            horario: event.horario,
                            responsavel: event.responsavel
                        }
                    }));
                    successCallback(events);
                    updateUpcomingEvents(events);
                    updateTodayEvents(events);
                })
                .catch(error => {
                    console.error('Erro ao carregar eventos:', error);
                    failureCallback(error);
                });
        },
        eventClick: function(info) {
            showEventModal(info.event);
        },
        dateClick: function(info) {
            // Destacar data clicada e mostrar eventos do dia
            showDayEvents(info.date);
        }
    });
    
    calendar.render();
    
    // Função para definir cores dos eventos
    function getEventColor(tipo) {
        const colors = {
            'reuniao': '#0d6efd',
            'audiencia': '#198754',
            'evento': '#ffc107',
            'sessao': '#0dcaf0',
            'outros': '#6c757d'
        };
        return colors[tipo] || colors['outros'];
    }
    
    // Mostrar modal com detalhes do evento
    function showEventModal(event) {
        const modal = new bootstrap.Modal(document.getElementById('eventModal'));
        
        document.getElementById('eventModalTitle').textContent = event.title;
        
        const modalBody = document.getElementById('eventModalBody');
        modalBody.innerHTML = `
            <div class="event-details">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary">Data e Horário</h6>
                        <p><i class="fas fa-calendar me-2"></i>${formatDate(event.start)}</p>
                        ${event.extendedProps.horario ? `<p><i class="fas fa-clock me-2"></i>${event.extendedProps.horario}</p>` : ''}
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">Tipo</h6>
                        <p><span class="badge" style="background-color: ${event.backgroundColor}">${event.extendedProps.tipo || 'Não informado'}</span></p>
                        ${event.extendedProps.responsavel ? `
                        <h6 class="text-primary">Responsável</h6>
                        <p>${event.extendedProps.responsavel}</p>
                        ` : ''}
                    </div>
                </div>
                ${event.extendedProps.location ? `
                <div class="mt-3">
                    <h6 class="text-primary">Local</h6>
                    <p><i class="fas fa-map-marker-alt me-2"></i>${event.extendedProps.location}</p>
                </div>
                ` : ''}
                ${event.extendedProps.description ? `
                <div class="mt-3">
                    <h6 class="text-primary">Descrição</h6>
                    <p>${event.extendedProps.description}</p>
                </div>
                ` : ''}
            </div>
        `;
        
        modal.show();
    }
    
    // Atualizar próximos eventos
    function updateUpcomingEvents(events) {
        const now = new Date();
        const upcoming = events
            .filter(event => new Date(event.start) > now)
            .sort((a, b) => new Date(a.start) - new Date(b.start))
            .slice(0, 5);
        
        const container = document.getElementById('upcomingEvents');
        
        if (upcoming.length === 0) {
            container.innerHTML = `
                <div class="text-center text-muted py-3">
                    <i class="fas fa-calendar-times fa-2x mb-2"></i>
                    <p class="mb-0">Nenhum evento próximo</p>
                </div>
            `;
            return;
        }
        
        container.innerHTML = upcoming.map(event => `
            <div class="event-item" onclick="showEventFromList('${event.id}')">
                <div class="event-time">${formatDate(event.start)}</div>
                <div class="event-title">${event.title}</div>
                ${event.extendedProps.location ? `<div class="event-description"><i class="fas fa-map-marker-alt me-1"></i>${event.extendedProps.location}</div>` : ''}
            </div>
        `).join('');
    }
    
    // Atualizar eventos de hoje
    function updateTodayEvents(events) {
        const today = new Date();
        const todayStr = today.toISOString().split('T')[0];
        
        const todayEvents = events.filter(event => 
            event.start.startsWith(todayStr)
        );
        
        const container = document.getElementById('todayEvents');
        
        if (todayEvents.length === 0) {
            container.innerHTML = `
                <div class="text-center text-muted py-4">
                    <i class="fas fa-calendar-check fa-2x mb-3"></i>
                    <p>Nenhum evento programado para hoje</p>
                </div>
            `;
            return;
        }
        
        container.innerHTML = todayEvents.map(event => `
            <div class="event-item" onclick="showEventFromList('${event.id}')">
                <div class="event-time">${event.extendedProps.horario || 'Horário não informado'}</div>
                <div class="event-title">${event.title}</div>
                ${event.extendedProps.location ? `<div class="event-description"><i class="fas fa-map-marker-alt me-1"></i>${event.extendedProps.location}</div>` : ''}
            </div>
        `).join('');
    }
    
    // Mostrar evento da lista
    window.showEventFromList = function(eventId) {
        const event = calendar.getEventById(eventId);
        if (event) {
            showEventModal(event);
        }
    };
    
    // Aplicar filtros
    window.applyFilters = function() {
        const eventType = document.getElementById('eventType').value;
        const dateRange = document.getElementById('dateRange').value;
        
        // Recarregar eventos com filtros
        calendar.refetchEvents();
    };
    
    // Formatar data
    function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString('pt-BR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }
    
    // Mostrar eventos do dia
    function showDayEvents(date) {
        calendar.gotoDate(date);
        // Aqui você pode adicionar lógica adicional para destacar o dia
    }
});
</script>
@endpush

