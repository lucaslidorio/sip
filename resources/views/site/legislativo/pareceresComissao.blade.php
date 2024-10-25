
@extends('site.legislativo.layouts.default')

@section('content')
{{Breadcrumbs::render('pareceres_comissao')}}

<div class="card rounded-0">
  <div class="card-header ">
    <h4 class="text-center">Pareceres</h4>
    <p  class="text-center fs-5">Pareceres das comissões</p>

    <form action="{{ route('camara.pareceres') }}" method="get">
      <div class="row">
        <div class="col-md-3">
          <label for="type_session_id" class="form-label">Tipo:</label>

          <select class="form-select" id="commission_id" name="commission_id">
            <option value="" selected>Selecione uma opção</option>
            @foreach ($commissions as $commission)
                <option value="{{ $commission->id }}"
                    {{ request()->query('commission_id') == $commission->id ? 'selected' : '' }}>
                    {{ $commission->nome }}
                </option>
            @endforeach
        </select>
        </div>
        <div class="col-sm-6 col-md-12 col-lg-6 col-xl-4 col-xxl-3">          
          <label for="data_inicio" class="form-label">Data Início:</label>
          <div class="input-group">
            <div class="input-group-prepend">                
              <span class="input-group-text  "><i class="bi bi-calendar3"></i></span>
            </div>
            <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="">
          </div>          
      </div>
      <div class="col-sm-6 col-md-12 col-lg-6 col-xl-4 col-xxl-3">          
        <label for="data_fim" class="form-label">Data Fim:</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
          </div>
          <input type="date" class="form-control " id="data_fim" name="data_fim" value="">
        </div>          
      </div>
      <div class="col-md-3 col-sm-6">
        <label for="ano" class="form-label">Ano:</label>
        <select class="form-select" id="ano" name="ano">
            <option value="" selected >Ano</option> 
            <option value="2018" {{ request()->query('ano') == '2018' ? 'selected': ''}}>2018 </option> 
            <option value="2019" {{ request()->query('ano') == '2019' ? 'selected': ''}}>2019 </option>                       
            <option value="2020" {{ request()->query('ano') == '2020' ? 'selected': ''}}>2020 </option> 
            <option value="2021" {{ request()->query('ano') == '2021' ? 'selected': ''}}>2021 </option>  
            <option value="2022" {{ request()->query('ano') == '2022' ? 'selected': ''}}>2022 </option>  
            <option value="2023" {{ request()->query('ano') == '2023' ? 'selected': ''}}>2023 </option>  
            <option value="2024" {{ request()->query('ano') == '2024' ? 'selected': ''}}>2024 </option>                              
        </select>
        {{-- bg-color-1 --}}
    </div>      
        <div class="col-sm-4 col-lg-2 pt-lg-4 mt-2">              
          <button class="btn  rounded-0 text-white btn-color" type="submit">
            <i class="bi bi-funnel"></i>
            Filtrar
          </button>
        </div>
      </div>
    </form>
  </div>
  <div class="card-body">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Comissão</th>
          <th scope="col">Propositura</th>
          <th scope="col">Data</th>
          <th scope="col">Autoria</th>
          <th scope="col">Anexo</th>
          <th scope="col" class="text-center">Ações</th>                 
        </tr>
      </thead>
      <tbody>
      @foreach ($seemCommissions as $seemCommission)
      <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{$seemCommission->commission->nome}}</td>
          <td>
              {{$seemCommission->proposition->type_proposition->nome}} 
              {{$seemCommission->proposition->numero}}/{{\Carbon\Carbon::parse($seemCommission->proposition->data)->format('Y')}}   
          </td>
          <td>{{\Carbon\Carbon::parse($seemCommission->data)->format('d/m/Y')}}</td>
          <td>{{$seemCommission->autoria}}</td>
          <td> @foreach ($seemCommission->attachments as $attachment)                   
              <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" 
                target="_blank" class="mb-2 text-reset"
                data-toggle="tooltip" data-placement="top" 
                    title={{$attachment->nome_original}} >
                    <i class="bi bi-file-earmark-pdf text-danger fs-3"></i>
              </a>                              
          @endforeach</td>                             
          <td class="text-center">
              <a href="{{route('camara.parecerShow', $seemCommission->id)}}" data-id=""
              class="btn  rounded-0 text-light btn-color " data-toggle="tooltip" data-placement="top"  
              title="Ver Detalhes" >
              <i class="bi bi-eye"></i> Abrir</i>
            </a>
          </td>
        
        </tr>
      @endforeach
      
      </tbody>
    </table>
      
  </div>
  <div class="card-footer text-muted">
    @if (!empty($filters))
    {!!$seemCommissions->appends($filters)->links()!!}
    @else
    {!!$seemCommissions->links()!!}
    @endif
  </div>
</div>

 
</section>
@endsection