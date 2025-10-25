@php
    $stats = getVisitStats();
@endphp

<div class="text-end py-2 pe-5">
    <i class="fas fa-users me-2 text-primary"></i>
    <span class="text-muted">
        Você é o visitante nº <strong class="text-primary">{{ number_format($stats['total'], 0, ',', '.') }}</strong>
    </span>
</div>
