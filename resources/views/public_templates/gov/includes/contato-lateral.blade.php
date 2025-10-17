<div class="sidebar-widget">
    <h3 class="sidebar-widget-title">Contato</h3>
    <div class="contact-info">
        @if($tenant->telefone)
        <p class="mb-2">
            <i class="fas fa-phone text-primary me-2"></i>
            <a href="tel:{{ $tenant->telefone }}">{{ $tenant->telefone }}</a>
        </p>
        @endif
        
        @if($tenant->email)
        <p class="mb-2">
            <i class="fas fa-envelope text-primary me-2"></i>
            <a href="mailto:{{ $tenant->email }}">{{ $tenant->email }}</a>
        </p>
        @endif
        
        @if($tenant->endereco)
        <p class="mb-0">
            <i class="fas fa-map-marker-alt text-primary me-2"></i>
            {{ $tenant->endereco }}
        </p>
        @endif
    </div>
</div>