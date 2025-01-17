@extends('public_templates.leg.default')
@section('content') 
<!-- meio da pagina com conteudos -->
<div class="content container">
    <div id="conteudo-pagina">
        <section class="col-sm-12">            
            <div class="row-content">                    
                @include('public_templates.leg.includes.destaques')
                @include('public_templates.leg.includes.ultilidades')
            </div>   
        </section>
    </div>
    <div class="row">
        @yield('content')
    </div>
    <div class="row-content">
        <section class="col-12">
            <div class="container">
                <div class="row">
                    @include('public_templates.leg.includes.acesso')
                    @include('public_templates.leg.includes.banner')
                </div>
            </div>
            
            @include('public_templates.leg.includes.vereadores')
            @include('public_templates.leg.includes.ouvidoria')
            @include('public_templates.leg.includes.noticias')
            @include('public_templates.leg.includes.diario-oficial')
            
            

           
        </section>
    </div>
</div>

@endsection