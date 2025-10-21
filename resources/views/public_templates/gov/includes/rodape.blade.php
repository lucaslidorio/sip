<!-- Footer -->
<footer class="footer-main">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h5>{{ $tenant->nome }}</h5>
                <p>{{ $tenant->endereco ?? 'Endereço não informado' }}
                    {{ $tenant->numero ?? ' ' }}
                    {{ $tenant->bairro ?? ' ' }}
                    {{ $tenant->cidade ?? ' ' }}
                </p>
                @if($tenant->telefone)
                <p><i class="fas fa-phone me-2"></i> {{ $tenant->telefone }}</p>
                @endif
                @if($tenant->email)
                <p><i class="fas fa-envelope me-2"></i> {{ $tenant->email }}</p>
                @endif
                @if($tenant->dia_atendimento)
                <p><i class="fas fa-clock"></i> {{ $tenant->dia_atendimento }}</p>
                @endif
            </div>
            <div class="footer-section">
                <h5>LOCALIZAÇÃO</h5>
                @if(!empty($tenant->maps))
                <div class="footer-map mb-2"
                    style="width:100%; max-width:250px; height:180px; overflow:hidden; display:flex; align-items:center; justify-content:center;">
                    {!! $tenant->maps !!}
                </div>
                @endif
            </div>
            @if($tenant->nome_resp_transparencia)
            <div class="footer-section">
                <h5>RESPONSÁVEL POR ASSEGURAR O CUMPRIMENTO DA LEI DE ACESSO A INFORMAÇÃO</h5>
                @if($tenant->nome_resp_transparencia)
                <p><i class="fas fa-user"></i> {{ $tenant->nome_resp_transparencia }}</p>
                @endif
                @if($tenant->telefone_resp_transparencia)
                <p><i class="fas fa-phone me-2"></i> {{ $tenant->telefone_resp_transparencia }}</p>
                @endif
                @if($tenant->telefone_resp_transparencia)
                <p><i class="fas fa-envelope me-2"></i> {{ $tenant->email_resp_transparencia }}</p>
                @endif

            </div>
            @endif
            @if($selosTransparencia && $selosTransparencia->count() > 0)
            <div class="footer-section">
                <h5>SELO DE TRANSPARÊNCIA</h5>
                <div class="selos-transparencia mt-3">
                    @foreach($selosTransparencia as $selo)                    
                        <img src="{{ config('app.aws_url').$selo->anexo }}" alt="{{ $selo->nome_original }}"
                            class="img-fluid mb-2" style="max-height: 80px; margin-right: 10px;">
                    
                    @endforeach
                </div>
            </div>
            @endif






        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ $tenant->nome }}. Todos os direitos reservados.</p>
            <p>Desenvolvido com <i class="fas fa-heart text-danger"></i> por <a
                    href="{{$tenant->developmentSettings->site}}"
                    target="_blank">{{$tenant->developmentSettings->nome_empresa}}</a></p>
        </div>
    </div>
</footer>