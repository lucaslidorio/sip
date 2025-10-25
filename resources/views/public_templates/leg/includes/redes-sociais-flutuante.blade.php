<!-- Adicione antes do fechamento do body -->
@if($tenant->facebook || $tenant->instagram || $tenant->youtube || $tenant->twitter || $tenant->tiktok)
<div class="social-float">
    <div class="social-float-inner">
        @if($tenant->facebook)
            <a href="{{ $tenant->facebook }}" target="_blank" class="social-icon facebook" title="Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
        @endif
        
        @if($tenant->instagram)
            <a href="{{ $tenant->instagram }}" target="_blank" class="social-icon instagram" title="Instagram">
                <i class="fab fa-instagram"></i>
            </a>
        @endif
        
        @if($tenant->youtube)
            <a href="{{ $tenant->youtube }}" target="_blank" class="social-icon youtube" title="YouTube">
                <i class="fab fa-youtube"></i>
            </a>
        @endif
        
        @if($tenant->twitter)
            <a href="{{ $tenant->twitter }}" target="_blank" class="social-icon twitter" title="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
        @endif
        
        @if($tenant->tiktok)
            <a href="{{ $tenant->tiktok }}" target="_blank" class="social-icon tiktok" title="TikTok">
                <i class="fab fa-tiktok"></i>
            </a>
        @endif
    </div>
</div>
@endif