@extends('adminlte::page')

@section('title', "Atualizar pergunta")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Editar pergunta -  <strong>{{$pergunta->numero}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item"><a href="{{ route('perguntas.index', $pergunta->questionario_id) }}">Perguntas</a></li>
          <li class="breadcrumb-item ">Editar Pergunta</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{route('perguntas.update', $pergunta->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            @include('admin.pages.pesquisas._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')
  <script>
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 
   

    document.addEventListener('DOMContentLoaded', function () {
        // Função para adicionar nova alternativa
        document.getElementById('add-alternativa').addEventListener('click', function () {
            const wrapper = document.getElementById('alternativas-wrapper');

            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');

            div.innerHTML = `
                <input type="text" name="alternativas[]" class="form-control" placeholder="Texto da alternativa" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-alternativa" title="Remover alternativa">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            wrapper.appendChild(div);
        });

        // Delegação de eventos para remover alternativa
        document.getElementById('alternativas-wrapper').addEventListener('click', function (e) {
            if (e.target.closest('.remove-alternativa')) {
                const button = e.target.closest('.remove-alternativa');
                const group = button.closest('.input-group');
                group.remove();
            }
        });
    });
</script>

  
@endsection
