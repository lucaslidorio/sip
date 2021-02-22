@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
<h1>Categorias</h1>
@include('sweetalert::alert')

<a href="{{route('categorias.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Novo</a>

<!--Alerta -->

@stop



@section('content')

<div class="card">
    <div class="card-header">
        #filtros
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">URL</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <th scope="row">{{$categoria->id}}</th>
                        <td>{{$categoria->nome}}</td>
                        <td>{{$categoria->url}}</td>
                        <td>{{$categoria->descricao}}</td>
                        <td>
                            <a href="{{route('categorias.destroy', $categoria->id)}}" class="btn btn-danger excluir"
                                data-toggle="tooltip" data-placement="top" title="Excluir">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>


                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>

@stop


@section('js')

<script>
    //Inicia os tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })  
    //Alert de confirmação de exclusão
    $(".excluir").click(function(e){
    e.preventDefault();
    


@stop