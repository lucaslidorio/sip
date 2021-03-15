@extends('adminlte::page')

@section('title', ' Permissões disponiveis - ')
@section('content_header')
@section('plugins.icheck-bootstrap', true)
    @include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Permissiões disponíveis para o perfil <strong>{{ $profile->nome }}</strong></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
                    <li class="breadcrumb-item "><a href="{{route('profiles.index')}}">Perfis</a></li>
                    <li class="breadcrumb-item a"><a href="{{route('profiles.permissions',$profile->id)}}">Permissões do perfil</a></li>
                    <li class="breadcrumb-item">Adicionar nova</li>
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
                        <div class="col-md-8">
                            
                        </div>
                        <div class="col-md-4">
                            <div class="card-tools">
                                <form action="{{ route('profile.permissions.available', $profile->id) }}" method="post"
                                    class="form form-inline  float-right">
                                    @csrf
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="pesquisa" class="form-control float-right"
                                            placeholder="Nome">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0 ">
                    <table class="table table-hover ">
                        <thead>
                            <tr>
                                <th width="40px">#</th>
                                <th class="pl-5">Nome </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <form action="{{route('profile.permissions.attach', $profile->id )}}" method="POST">
                                @csrf
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>                                           
                                            <div class="icheck-primary">
                                                <input type="checkbox" name="permissions[]" value="{{$permission->id}}" id="{{$permission->id}}" />
                                                <label for="{{$permission->id}}"></label>
                                             </div>
                                            </td>
                                        <td>
                                            <div class="icheck-primary">
                                                <label for="{{$permission->id}}">{{$permission->nome}}</label>   
                                            </div>                                           
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="500">
                                        <button type="submit" class="btn btn-success">Vincular</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                
                    @if (isset($pesquisar))
                        {!! $permissions->appends($pesquisar)->links() !!}
                    @else
                        {!! $permissions->links() !!}
                    @endif
                </div>
            </div>
            <!-- /.card -->
        </div>        
    </div>
  
@stop

@section('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        //Inicia os tooltip
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        //Alert de confirmação de exclusão
        $('.delete-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: 'Deseja continuar',
                text: 'Este registro e seus detalhes serão excluídos permanentemente!',
                icon: 'warning',
                buttons: ["Cancelar", "Sim, Excluir!"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });

    </script>


@stop
