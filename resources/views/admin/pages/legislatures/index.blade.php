@extends('adminlte::page')
@section('title', 'Legislaturas')
@section('content_header')
@include('sweetalert::alert')


<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Legislaturas</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Legislaturas</li>
      </ol>
    </div>
  </div>
</div>
<!--Alerta -->

@stop

@section('content')





<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
        @foreach ($legislatures as $legislature)
        <div id="accordion">
          <div class="card  {{ $loop->first ? 'card-primary' : 'card-secondary' }}">
            <div class="card-header">
              <h4 class="card-title w-100">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                  {{$legislature->descricao}}
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="collapse  {{ $loop->first ? 'show' : 'border-light' }}" data-parent="#accordion">
              <div class="card-body">
               <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th scope="col">SESSÃO</th>
                      <th scope="col">PERÍODO</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($legislature->sections as $section)
                    <tr>                      
                        <td rowspan="2">{{$section->descricao}}</td>                      
                      
                        <td>                          
                          @foreach ($section->periods as $period)
                          <p>{{$period->descricao}}</p>                                                                         
                          @endforeach
                        </td>                
                    </tr>
                    <tr>                 
                                   
                    </tr>
                    @endforeach
                  </tbody>
                </table>      
              </div>
              <div class="card-footer">
                @if ($loop->first)
                <span class="text-monospace">* Legislalatura Virgente</span>
                    
                @endif
              </div>
            </div>
          </div>
         
         
        </div>
        @endforeach
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>  

  




            {{-- @foreach ($legislatures as $legislature)
            <div class="card {{ $loop->first ? 'border-success' : 'border-light' }}" style="border:1px solid;">
              <h5 class="card-header "><strong> {{$legislature->descricao}} </strong></h5>
              <div class="card-body ">
                          
                <table class="table table-bordered table-sm">
                  <thead>
                    <tr>
                      <th scope="col">SESSÃO</th>
                      <th scope="col">PERÍODO</th>                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($legislature->sections as $section)
                    <tr>                      
                        <td rowspan="2">{{$section->descricao}}</td>                      
                      
                        <td>
                          
                          @foreach ($section->periods as $period)
                          <p>{{$period->descricao}}</p>                                               
                          @endforeach
                        </td>                
                    </tr>
                    <tr>                 
                                   
                    </tr>
                    @endforeach
                  </tbody>
                </table>                
              </div>
            </div>
                        
           
            @endforeach --}}
            {{-- {{ $loop->index % 2 == 0 ? 'text-white bg-success' : 'text-white bg-danger' }} --}}
@stop

@section('js')
<script>
  //Inicia os tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
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