 @if($linksUteisInferior && $linksUteisInferior->count() > 0)
                <div class="sidebar-widget">
                    <h3 class="sidebar-widget-title">Links Úteis</h3>
                    @foreach($linksUteisInferior as $link)
                    <div class="mb-3">
                        <a href="{{ $link->url }}" target="_blank" class="text-decoration-none d-flex align-items-center link-util-sidebar">
                            @if($link->icone)
                            <div class="link-icon-wrapper me-2">
                                <img src="{{config('app.aws_url').$link->icone}}" 
                                     alt="{{ $link->titulo }}" 
                                     class="img-fluid rounded"
                                     style="max-height: 50px; width: auto;">
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $link->nome }}</h6>
                                @if($link->descricao)
                                <small class="text-muted">{{ Str::limit($link->descricao, 60) }}</small>
                                @endif
                            </div>
                            @else
                            <div class="card w-100">
                                <div class="card-body text-center">
                                    <h6 class="card-title">{{ $link->nome }}</h6>
                                    @if($link->descricao)
                                    <p class="card-text small">{{ $link->descricao }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif