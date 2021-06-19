@extends('adminlte::page')

@section('title', "Detelhe do Parlamentar")

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Detalhes da  <strong>{{$legislature->descricao}}</strong></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('legislatures.index')}}">Legislaturas </a></li>
          <li class="breadcrumb-item ">Detalhes</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card mb-3 mt-3">

  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-light" role="alert">
          @foreach($legislature->bienniuns as $bienniun)
             <h6 class="mr-3">{{$bienniun->descricao}}
                <strong class=" ml-3 mr-3 "> DATA INÍCIO </strong>
                {{\Carbon\Carbon::parse($bienniun->data_inicio)->format('d/m/Y')}}
                <strong class="ml-3 mr-3 "> DATA FIM </strong>
                {{\Carbon\Carbon::parse($bienniun->data_fim)->format('d/m/Y')}}
              </h6>                   
          @endforeach
        </div>
           
      </div>
    </div> 
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
  <div class="row no-gutters " style="padding:20px">
    
    <div class="col-md-5" style="padding-left: 15px" >     
      
    </div>
    <div class="col-md-5" style="padding-left: 15px">  
       
        
        
      
    </div>
    
  </div>
  <div class="card-footer">
   
  </div>
 
</div>


@section('js')
<script>  
  //inicia o tooltip
  $(function () {
   $('[data-toggle="tooltip"]').tooltip()
  }) 
 
</script>
    
@endsection
@stop
