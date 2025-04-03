@if($menus3->count())
<div class="col">
    <div class="col-md-12 col-sm-12">
        <section class="quick-access">
            <div class="cabecalho-secao-3" style="padding-bottom: 20px;">
                <h1><span>ACESSO</span></h1>
            </div>

            <ul class="row lista1">
                @foreach($menus3 as $index => $menu)
                    @php
                        // Define a classe da coluna dinamicamente
                        $colClass = ($index < 2) ? 'col-md-6 col-sm-6 col-xs-6' : 'col-md-4 col-sm-4 col-xs-4';
                    @endphp
                    <li class="{{ $colClass }}">
                        <a href="{{ $menu->url }}" @if($menu->target) target="_blank" @endif>
                            <i class="{{ $menu->icone }}" aria-hidden="true"></i>
                            <br /> {!! nl2br(e($menu->nome)) !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    </div>
</div>
@endif