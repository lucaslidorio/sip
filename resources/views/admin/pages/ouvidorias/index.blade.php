@extends('adminlte::page')
@section('title', 'Propositura')
@section('content_header')
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Ouvidorias</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Ouvidoria</li>
      </ol>
    </div>
  </div>
</div>
<!--Alerta -->

@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          {{-- <div class="col-md-3">            
            <a href="{{route('ouvidorias.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Cadastrar nova propositura" ><i
                class="fas fa-plus"></i> Novo</a>
          </div> --}}
          <div class="col-md-9">            
                {{-- <form action="{{route('ouvidorias.index')}}" method="get" class="form form-inline">
                  @csrf             
                  <div class="col-4">
                    <select class="form-control" 
                      name="proceeding_situation_id" id="proceeding_situation_id" style="width: 100%;" >
                      <option value="" selected >Selecione uma situacao</option>   
                      @foreach ($situacoes as $situacao)                          
                      <option value="{{$situacao->id}}"
                        {{ request()->query('proceeding_situation_id') == $situacao->id ? 'selected' : '' }}>
                            {{$situacao->nome}}             
                          </option>
                      @endforeach 
                  </select>
                  </div>                 
                  <div class="col-2">
                    <select class="form-control " 
                      name="ano" id="ano" style="width: 100%;" >
                      <option value="" selected >Ano</option> 
                      <option value="2018" {{ request()->query('ano') == '2018' ? 'selected': ''}}>2018 </option> 
                      <option value="2019" {{ request()->query('ano') == '2019' ? 'selected': ''}}>2019 </option>                       
                      <option value="2020" {{ request()->query('ano') == '2020' ? 'selected': ''}}>2020 </option> 
                      <option value="2021" {{ request()->query('ano') == '2021' ? 'selected': ''}}>2021 </option>  
                      <option value="2022" {{ request()->query('ano') == '2022' ? 'selected': ''}}>2022 </option>  
                      <option value="2023" {{ request()->query('ano') == '2023' ? 'selected': ''}}>2023 </option>  
                      <option value="2024" {{ request()->query('ano') == '2024' ? 'selected': ''}}>2024 </option>    
                     
                  </select>
                  </div>
                  <div class="col-2">
                    <select class="form-control " 
                      name="ordenacao" id="ordenacao" style="width: 100%;" >
                      <option value="" selected >Ordenar por</option> 
                      <option value="ASC" {{ request()->query('ordenacao') == 'ASC' ? 'selected': ''}}>Número crescente </option> 
                      <option value="DESC" {{ request()->query('ordenacao') == 'DESC' ? 'selected': ''}}>Número decrescente </option>                 
                                         
                  </select>
                  </div>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input type="text" name="pesquisa" id="pesquisa" class="form-control" placeholder="Pesquisar pela descrição">
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat" data-toggle="tooltip" data-placement="top"
                        title="Pesquisar" ><i class="fas fa-search"></i></button>
                      </span>
                    </div>
                  </div>            
                </form> --}}
              </div>            
          </div>
        </div>
        
   
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Protocolo</th>
              <th scope="col">Sigiloso</th> 
              <th scope="col">Assunto</th>  
              <th scope="col">Tipo</th>
              <th scope="col">Data</th>
              <th scope="col">Descrição</th>               
              <th scope="col">Arquivo</th>
              <th scope="col" width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($ouvidorias as $ouvidoria)               
           
            <tr >
              <th scope="row">{{$loop->iteration}}</th>
              <td class="text-bol">{{$ouvidoria->codigo}}</td>
              <td class="{{$ouvidoria->sigiloso ? 'text-danger': ''}}">{{$ouvidoria->sigiloso ? 'Sim': 'Não'}}</td>
              <td>{{$ouvidoria->assunto_ouvidoria ? $ouvidoria->assunto_ouvidoria->nome : ''}}</td> 
              <td>{{$ouvidoria->tipo_ouvidoria ? $ouvidoria->tipo_ouvidoria->nome : ''}}</td>    
              <td>{{\Carbon\Carbon::parse($ouvidoria->created_at)->format('d/m/Y')}}</td>            
              
              <td>
              {{Str::of($ouvidoria->manifestacao)->limit(30, '...')}}  
              </td>           
              <td>                
                  @foreach ($ouvidoria->anexos as $anexo)                   
                  <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" 
                    target="_blank" class="mb-2 text-reset"
                    data-toggle="tooltip" data-placement="top" 
                        title={{$anexo->nome_original}} >
                      <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
                  </a>                             
                  @endforeach                 
              </td> 
                <td class="text-center">
                <a href="{{route('ouvidorias.edit', $ouvidoria->id)}}" 
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                  title="Editar">
                  <i class="fas fa-edit" ></i>
                </a>

                <a href="{{route('ouvidorias.show', $ouvidoria->id)}}" data-id="{{$ouvidoria->id}}"
                  class="btn  bg-gradient-info btn-flat mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Ver Detalhes">
                  <i class="fas fa-address-book" ></i>
                </a>

                <a href="{{route('ouvidorias.destroy', $ouvidoria->id)}}" data-id="{{$ouvidoria->id}}"
                  class="btn  bg-gradient-danger btn-flat delete-confirm mt-0" data-toggle="tooltip" data-placement="top"  
                  title="Excluir">
                  <i class="fas fa-trash-alt" ></i>
                </a>
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        @if (isset($filters))
        {!!$ouvidorias->appends($filters)->links()!!}
        @else
        {!!$ouvidorias->links()!!}
        @endif
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop
@section('js')
<script>
  //Inicia os tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()

        $('.popover-dismiss').popover({
            trigger: 'focus'
        })
    })  //Alert de confirmação de exclusão
    $('.delete-confirm').on('click', function (event) {
    event.preventDefault();
    const url = $(this).attr('href');    
          Swal.fire({
          title: 'Deseja continuar?',
          text: "Este registro e seus detalhes serão excluídos permanentemente!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText:'Cancelar',
          confirmButtonText: 'Sim, Exclua!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = url;
          }
        })  
});
</script>
@stop