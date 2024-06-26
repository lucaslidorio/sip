@extends('adminlte::page')

@section('title', "Detalhes do Proceso")

@section('content_header')




<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>404 Página não encontrada</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
                    <li class="breadcrumb-item active">Página não encontrada</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! {{ $message }}.</h3>
            <p>
                Não foi possível encontrar a página que você procurava
                Enquanto isso, você pode <a href="{{route('dashboard.index')}}">voltar ao painel inícial</a>
            </p>

        </div>

    </div>

</section>


@endsection