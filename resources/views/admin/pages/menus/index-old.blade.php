@extends('adminlte::page')
@section('title', 'Menus')
@section('content_header')
@section('plugins.Sweetalert2', true)
@include('sweetalert::alert')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Menus</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "><a href="{{route('menus.index')}}">Menus</a></li>
      </ol>
    </div>
  </div>
</div>

@stop
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-4">            
            <a href="{{route('menus.create')}}" class="btn bg-gradient-success  " data-toggle="tooltip" data-placement="top"
            title="Cadastrar novo menu" ><i
                class="fas fa-plus"></i> Novo</a>
          </div>
          <div class="col-md-8 ">
            <form action="{{ route('menus.index') }}" method="GET" class="form form-inline">
              @csrf
              <div class="col-4">
                  <select class="form-control" name="menu_pai_id" id="menu_pai_id" style="width: 100%;">
                      <option value="" selected>Menu Pai</option>
                      @foreach ($menusPais as $menu)
                      <option value="{{ $menu->id }}"
                          {{ request()->query('menu_pai_id') == $menu->id ? 'selected' : '' }}>
                          {{ $menu->nome }}
                      </option>
                  @endforeach
                  </select>
                  
              </div>
              <div class="col-4">
                <select class="form-control" name="posicao" id="posicao" style="width: 100%;">
                    <option value="" selected>Posição</option>
                    @foreach ($posicao as $key => $value)
                        <option value="{{ $key }}"
                            {{ request()->query('posicao') == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>
              <div class="col-md-4">
                  <div class="input-group">
                      <input type="text" name="pesquisa" id="pesquisa" class="form-control" placeholder="Nome, url, slug." 
                             value="{{ request()->query('pesquisa') }}">
                      <span class="input-group-append">
                          <button type="submit" class="btn btn-info btn-flat" data-toggle="tooltip" data-placement="top"
                                  title="Pesquisar"><i class="fas fa-search"></i></button>
                      </span>
                  </div>
              </div>
          </form>
          </div>
        </div> 
      </div>     
   
      <!-- /.card-header -->
      <div class="card-body table-responsive-smg p-0">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>              
              <th>Nome</th>
              <th>Pai</th>
              <th>Slug</th>
              <th>Target</th>   
              <th>Url</th>    
              <th>Posicao</th> 
              <th>Ordenação</th>      
              <th width="20%" class="text-center">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($menus as $menu)            
            <tr >
              <td>{{$menu->id}}</td>              
              <td>{{$menu->nome}}</td>
              <td>{{$menu->menu_pai_id ? $menu->getMenuPai($menu->menu_pai_id)->nome : '--'}}</td>
              <td>{{$menu->slug}}</td>
              <td>{{($menu->target ? 'Sim': 'Não')}}</td>
              <td>{{$menu->url}}</td>
              <td>{{$posicao[$menu->posicao]}}</td>
              <td>{{$menu->ordem}} º</td>
             <td class="text-center">
                <a href="{{route('menus.edit', $menu->id)}}" 
                  class="btn  bg-gradient-primary btn-flat  " data-toggle="tooltip" data-placement="top" 
                  title="Editar">
                  <i class="fas fa-edit" ></i>
                </a>

                <a href="{{route('menus.destroy', $menu->id)}}" data-id="{{$menu->id}}"
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
        @if (isset($pesquisar))
        {!!$menus->appends($pesquisar)->links()!!}
        @else
        {!!$menus->links()!!}
        @endif
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@stop

@section('js')
<script>
//Swal.fire('Any fool can use a computer');  
  //Inicia os tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })  
    //Alert de confirmação de exclusão
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