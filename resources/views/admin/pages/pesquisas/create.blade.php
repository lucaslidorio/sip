@extends('adminlte::page')

@section('title', 'Cadastrar nova pergunta')
@section('plugins.Select2', true)

@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Cadastrar nova pergunta</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('perguntas.index', $questionario_id) }}">Perguntas</a></li>
                <li class="breadcrumb-item">Nova Pergunta</li>
            </ol>
        </div>
    </div>
</div>
@include('sweetalert::alert')
@stop

@section('content')
<div class="card">
  <div class="card-body">
    <form action="{{ route('perguntas.store', $questionario_id) }}" method="POST">
        @csrf
        @include('admin.pages.pesquisas._partials.form')
    </form>
  </div>
</div>
@stop

@section('js')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();

        // Adicionar nova alternativa
        $('#add-alternativa').click(function () {
            const html = `
                <div class="input-group mb-2">
                    <input type="text" name="alternativas[]" class="form-control" placeholder="Texto da alternativa" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-alternativa" title="Remover alternativa"><i class="fas fa-times"></i></button>
                    </div>
                </div>`;
            $('#alternativas-wrapper').append(html);
        });

        // Remover alternativa
        $(document).on('click', '.remove-alternativa', function () {
            $(this).closest('.input-group').remove();
        });
    });
</script>
@stop
