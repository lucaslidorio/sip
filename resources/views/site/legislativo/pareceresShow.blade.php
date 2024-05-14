
@extends('site.legislativo.layouts.default')

@section('content')
{{Breadcrumbs::render('parecer', $seemCommission)}}
<div class="card rounded-0">
  <div class="card-header ">
    <h4 class="text-center">Pareceres</h4>
    <p  class="text-center fs-5">Pareceres das comissões</p>
           
        
     
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Data</th>  
          <th scope="col">{{\Carbon\Carbon::parse($seemCommission->data)->format('d/m/Y')}}</th>              
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">Autoria</th>
          <td>{{$seemCommission->autoria}}</td>          
        </tr>
        <tr>
          <th scope="row">Assunto</th>
          <td>{{$seemCommission->assunto}}</td>
        </tr>
        <tr>
          <th scope="row">Descrição</th>
          <td colspan="2">{{$seemCommission->descricao}}</td>                
        </tr>
        <tr>
          <th scope="row">Anexo(s)</th>
          <td >
            @foreach ($seemCommission->attachments as $anexo)
            <a href="{{config('app.aws_url')."{$anexo->anexo}" }}" 
              target="_blank" class="mb-2 text-reset"
              data-toggle="tooltip" data-placement="top" 
                  title="Clique para abrir o documento" >
                  <i class="bi bi-file-earmark-pdf text-danger fs-3"></i>                          
                <span class="mr-2"> {{$anexo->nome_original}}</span>                
            </a>
            @endforeach
          </td>                
        </tr>
      </tbody>
    </table>
      
  </div>
  <div class="card-footer text-muted">
    <div class="row">
      <div class="col-sm-12">
        <a href="{{route('camara.pareceres')}}" data-id=""
        class="btn  btn-primary rounded-0  " data-toggle="tooltip" data-placement="top"  
        title="Voltar" style="background-color: #0b468e">
        <i class="bi bi-arrow-90deg-left"></i>  Voltar</i>
      </a>
      </div>
    </div>
  </div>
</div>

 
</section>
@endsection