@extends('adminlte::page')
@section('title', 'Categorias')
@section('content_header')
@section('plugins.Sweetalert2', true)
@section('plugins.inputmask', true)
@include('sweetalert::alert')
@section('plugins.icheck-bootstrap', true)
@section('plugins.dropzone', true)
{{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}
{{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Perfil</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item ">Perfil</li>
      </ol>
    </div>
  </div>
</div>

@stop
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-3">

      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg"
              alt="User profile picture">
          </div>
          <h3 class="profile-username text-center">{{$user->name}}</h3>
          <p class="text-muted text-center">Software Engineer</p>
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Followers</b> <a class="float-right">1,322</a>
            </li>
            <li class="list-group-item">
              <b>Following</b> <a class="float-right">543</a>
            </li>
            <li class="list-group-item">
              <b>Friends</b> <a class="float-right">13,287</a>
            </li>
          </ul>
          <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
        </div>
      </div>


      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Sobre</h3>
        </div>

        <div class="card-body">
          <strong><i class="fas fa-phone-alt mr-1"></i> Contato</strong>
          <p class="text-muted">
            <strong>Email: </strong>{{ $user->dados_pessoais->email ?? 'Não Informado' }} <br>
            <strong>Telefone: </strong>{{ $user->dados_pessoais->telefone ?? 'Não Informado' }} <br>
            <strong>Celular: </strong>{{ $user->dados_pessoais->celular ?? 'Não Informado' }} <br>
            <strong>Site: </strong>{{ $user->dados_pessoais->site ?? 'Não Informado' }}

          </p>
          <hr>
          <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>
          <p class="text-muted">
            {{ $user->dados_pessoais->endereco ?? 'Não Informado' }} ,
            {{ $user->dados_pessoais->numero ?? 'Não Informado' }},
            {{ $user->dados_pessoais->bairro ?? 'Não Informado' }},
            {{ $user->dados_pessoais->cidade ?? 'Não Informado' }},
            {{ $user->dados_pessoais->estado ?? 'Não Informado' }},
            {{ $user->dados_pessoais->cep ?? 'Não Informado' }}
          </p>
         
        </div>

      </div>

    </div>

    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Meus Dados</a></li>            
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Editar Dados</a></li>
            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"> Enviar Documentos</a></li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">

              <div class="post">
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                  <span class="username">
                    <a href="#">{{ $user->dados_pessoais->nome_fantasia ?? 'Informado' }}</a>                  </span>
                  <span class="description">{{ $user->dados_pessoais->razao_social ?? 'Não Informado' }}</span>
                  

                    <div class="card mt-3">
                      <div class="card-header">                      
                        <h5><i class="fas fa-database "></i> Meus Dados</h5>                      
                      </div>
                      <div class="card-body">
                        <div class=" " style="padding-left: 15px">
                          <p class="card-text"><strong>Tipo de Pessoa: </strong>{{ $user->dados_pessoais->tipo_pessoa ??
                            'Não Informado' }}</p>
                          <p class="card-text"><strong>Natureza Jurídica: </strong>{{
                            $user->dados_pessoais->natureza_juridica ?? 'Não Informado' }}</p>
                          <p class="card-text"><strong>Natureza Jurídica: </strong>{{
                            $user->dados_pessoais->natureza_juridica ?? 'Não Informado' }}</p>
                          <p class="card-text"><strong>Enquadramento: </strong>{{ $user->dados_pessoais->enquadramento ??
                            'Não Informado' }}</p>
                          <p class="card-text"><strong>Razão Social: </strong>{{ $user->dados_pessoais->razao_social ?? 'Não
                            Informado' }}</p>
                          <p class="card-text"><strong>CNPJ: </strong>{{ $user->dados_pessoais->cnpj ?? 'Não Informado' }}
                          </p>
                          <p class="card-text"><strong>Insc. Estadual: </strong>{{ $user->dados_pessoais->inscricao_estadual
                            ?? 'Não Informado' }}</p>
                          <p class="card-text"><strong>Data de Abertura : </strong>
                            <td>{{ !empty($user->dados_pessoais->data_abertura) ? Carbon\Carbon::parse($user->dados_pessoais->data_abertura)->format('d/m/Y') : '-' }}</td>
                          </p>
                        </div>
                       
                      </div>
                    </div>
                    
           



                  <div class="card mt-3">
                    <div class="card-header">                      
                      <h5><i class="fas fa-folder "></i> Meus Documentos</h5>                      
                    </div>
                    <div class="card-body">
                      <div class="timeline-body">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                        <img src="https://placehold.it/150x100" alt="...">
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            

            <div class="tab-pane" id="settings">
              <form class="form-horizontal" id="dadosPessoa" action="{{route('users.perfil.store', $user->id)}}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label label-required">Tipo de Pessoa</label>
                  <div class="col-sm-10">
                    <select class="custom-select {{ $errors->has('tipo_pessoa') ? 'is-invalid' : '' }}" id="tipo_pessoa"
                      name="tipo_pessoa">
                      <option value="" >Selecione uma opção</option>
                      <option value="F" {{isset($user) && $user->dados_pessoais->tipo_pessoa == 'F' ? 'selected': ''}}> Fisíca
                      </option>
                      <option value="J" {{isset($user) && $user->dados_pessoais->tipo_pessoa == 'J' ? 'selected': ''}}> Jurídica </option>
                    </select>
                    @error('tipo_pessoa')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label label-required">Natureza Jurídica</label>
                  <div class="col-sm-10">
                    <select class="custom-select {{ $errors->has('natureza_juridica') ? 'is-invalid' : '' }}"
                      id="natureza_juridica" name="natureza_juridica">
                      <option value="" selected>Selecione uma opção</option>
                      <option value="EI" {{isset($user) && $user->dados_pessoais->natureza_juridica == 'EI' ? 'selected': ''}}> EI
                      </option>
                      <option value="LTDA" {{isset($user) && $user->dados_pessoais->natureza_juridica == 'LTDA' ? 'selected': ''}}> LTDA
                      </option>
                      <option value="SA" {{isset($user) && $user->dados_pessoais->natureza_juridica == 'SA' ? 'selected': ''}}> SA
                      </option>
                    </select>
                    @error('natureza_juridica')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="enquadramento" class="col-sm-2 col-form-label label-required">Enquadramento</label>
                  <div class="col-sm-10">
                    <select class="custom-select {{ $errors->has('enquadramento') ? 'is-invalid' : '' }}"
                      id="enquadramento" name="enquadramento">
                      <option value="" selected>Selecione uma opção</option>
                      <option value="MIC" {{ isset($user) && $user->dados_pessoais->enquadramento == 'MIC' ? 'selected': '' }}>Micro
                        Empresa (MIC)</option>
                      <option value="EPP" {{ isset($user) && $user->dados_pessoais->enquadramento == 'EPP' ? 'selected': '' }}>Empresa
                        de Pequeno Porte (EPP)</option>
                      <option value="GP" {{ isset($user) && $user->dados_pessoais->enquadramento == 'GP' ? 'selected': '' }}>Grande
                        Porte (GP)</option>
                      <option value="DE" {{ isset($user) && $user->dados_pessoais->enquadramento == 'DE' ? 'selected': '' }}>Demais
                        Empresas (DE)</option>
                      <option value="COOP" {{ isset($user) && $user->dados_pessoais->enquadramento == 'COOP' ? 'selected': ''
                        }}>Cooperativas (COOP)</option>
                    </select>
                    @error('enquadramento')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>




                <div class="form-group row">
                  <label for="nome_fantasia" class="col-sm-2 col-form-label  label-required">Nome Fantasia                   
                  </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('nome_fantasia') ? 'is-invalid' : '' }}"
                      id="nome_fantasia" name="nome_fantasia" placeholder="Nome fantasia"
                      value="{{$user->dados_pessoais->nome_fantasia}}">
                    @error('nome_fantasia')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="razao_social" class="col-sm-2 col-form-label">Razão Social</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('razao_social') ? 'is-invalid' : '' }}"
                      id="razao_social" name="razao_social" placeholder="Razão social da empresa"
                      value="{{ $user->dados_pessoais->razao_social ?? old('razao_social') }}">
                    @error('razao_social')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="cnpj" class="col-sm-2 col-form-label">CNPJ/CPF</label>
                  <div class="col-sm-10">
                    <input type="text"
                  
                    class="form-control {{ $errors->has('cnpj') ? 'is-invalid' : '' }}"
                      id="cnpj" name="cnpj" placeholder="Cnpj ou cpf"
                      value="{{ $user->dados_pessoais->cnpj ?? old('cnpj') }}">
                    @error('cnpj')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inscricao_estadual" class="col-sm-2 col-form-label">Incrição Estadual</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control {{ $errors->has('inscricao_estadual') ? 'is-invalid' : '' }}"
                      id="inscricao_estadual" name="inscricao_estadual" placeholder="Inscrição estadual"
                      value="{{ $user->dados_pessoais->inscricao_estadual ?? old('inscricao_estadual') }}">
                    @error('inscricao_estadual')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="data_abertura" class="col-sm-2 col-form-label">Data de Abertura</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control {{ $errors->has('data_abertura') ? 'is-invalid' : '' }}"
                      id="data_abertura" name="data_abertura" placeholder="data"
                      value="{{ $user->dados_pessoais->data_abertura ?? old('data_abertura') }}">
                    @error('data_abertura')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="endereco" class="col-sm-2 col-form-label">Endereço</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}"
                      id="endereco" name="endereco" placeholder="Endereço"
                      value="{{ $user->dados_pessoais->endereco ?? old('endereco') }}">
                    @error('endereco')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="numero" class="col-sm-2 col-form-label">Número</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}"
                      id="numero" name="numero" placeholder="Número" maxlength="6"
                      value="{{ $user->dados_pessoais->numero ?? old('numero') }}">
                    @error('numero')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bairro" class="col-sm-2 col-form-label">Bairro</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}"
                      id="bairro" name="bairro" placeholder="Bairro" 
                      value="{{ $user->dados_pessoais->bairro ?? old('bairro') }}">
                    @error('bairro')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="cidade" class="col-sm-2 col-form-label">Cidade</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}"
                      id="cidade" name="cidade" placeholder="Cidade" 
                      value="{{ $user->dados_pessoais->cidade ?? old('cidade') }}">
                    @error('cidade')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                

                <div class="form-group row">
                  <label for="cep" class="col-sm-2 col-form-label">Cep</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}"
                      id="cep" name="cep" placeholder="Cep"
                      value="{{ $user->dados_pessoais->cep ?? old('cep') }}">
                    @error('cep')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="estado" class="col-sm-2 col-form-label label-required">Estado</label>
                  <div class="col-sm-10">
                    <select class="custom-select {{ $errors->has('estado') ? 'is-invalid' : '' }}"
                      id="estado" name="estado">
                     <option value="" selected>Selecione uma opção</option>
                      <option value="">Selecione um estado</option>
                      <option value="AC" {{ isset($user) && $user->dados_pessoais->estado == 'AC' ? 'selected' : '' }}>Acre</option>
                      <option value="AL" {{ isset($user) && $user->dados_pessoais->estado == 'AL' ? 'selected' : '' }}>Alagoas</option>
                      <option value="AP" {{ isset($user) && $user->dados_pessoais->estado == 'AP' ? 'selected' : '' }}>Amapá</option>
                      <option value="AM" {{ isset($user) && $user->dados_pessoais->estado == 'AM' ? 'selected' : '' }}>Amazonas</option>
                      <option value="BA" {{ isset($user) && $user->dados_pessoais->estado == 'BA' ? 'selected' : '' }}>Bahia</option>
                      <option value="CE" {{ isset($user) && $user->dados_pessoais->estado == 'CE' ? 'selected' : '' }}>Ceará</option>
                      <option value="DF" {{ isset($user) && $user->dados_pessoais->estado == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                      <option value="ES" {{ isset($user) && $user->dados_pessoais->estado == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                      <option value="GO" {{ isset($user) && $user->dados_pessoais->estado == 'GO' ? 'selected' : '' }}>Goiás</option>
                      <option value="MA" {{ isset($user) && $user->dados_pessoais->estado == 'MA' ? 'selected' : '' }}>Maranhão</option>
                      <option value="MT" {{ isset($user) && $user->dados_pessoais->estado == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                      <option value="MS" {{ isset($user) && $user->dados_pessoais->estado == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                      <option value="MG" {{ isset($user) && $user->dados_pessoais->estado == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                      <option value="PA" {{ isset($user) && $user->dados_pessoais->estado == 'PA' ? 'selected' : '' }}>Pará</option>
                      <option value="PB" {{ isset($user) && $user->dados_pessoais->estado == 'PB' ? 'selected' : '' }}>Paraíba</option>
                      <option value="PR" {{ isset($user) && $user->dados_pessoais->estado == 'PR' ? 'selected' : '' }}>Paraná</option>
                      <option value="PE" {{ isset($user) && $user->dados_pessoais->estado == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                      <option value="PI" {{ isset($user) && $user->dados_pessoais->estado == 'PI' ? 'selected' : '' }}>Piauí</option>
                      <option value="RJ" {{ isset($user) && $user->dados_pessoais->estado == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                      <option value="RN" {{ isset($user) && $user->dados_pessoais->estado == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                      <option value="RS" {{ isset($user) && $user->dados_pessoais->estado == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                      <option value="RO" {{ isset($user) && $user->dados_pessoais->estado == 'RO' ? 'selected' : '' }}>Rondônia</option>
                      <option value="RR" {{ isset($user) && $user->dados_pessoais->estado == 'RR' ? 'selected' : '' }}>Roraima</option>
                      <option value="SC" {{ isset($user) && $user->dados_pessoais->estado == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                      <option value="SP" {{ isset($user) && $user->dados_pessoais->estado == 'SP' ? 'selected' : '' }}>São Paulo</option>
                      <option value="SE" {{ isset($user) && $user->dados_pessoais->estado == 'SE' ? 'selected' : '' }}>Sergipe</option>
                      <option value="TO" {{ isset($user) && $user->dados_pessoais->estado == 'TO' ? 'selected' : '' }}>Tocantins</option>
                      </select>
                      @error('estado')
                      <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="telefone" class="col-sm-2 col-form-label">Telefone</label>
                  <div class="col-sm-10">
                    <input type="text" data-inputmask="'mask': '(99) 9999-9999'" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}"
                      id="telefone" name="telefone" placeholder="Telefone"
                      value="{{ $user->dados_pessoais->telefone ?? old('telefone') }}">
                    @error('telefone')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="celular" class="col-sm-2 col-form-label">Celular</label>
                  <div class="col-sm-10">
                    <input type="text" data-inputmask="'mask': '(99) 999999999'" class="form-control {{ $errors->has('celular') ? 'is-invalid' : '' }}"
                      id="celular" name="celular" placeholder="Celular"
                      value="{{ $user->dados_pessoais->celular ?? old('celular') }}">
                    @error('celular')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="site" class="col-sm-2 col-form-label">Site</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('site') ? 'is-invalid' : '' }}"
                      id="site" name="site" placeholder="Site"
                      value="{{ $user->dados_pessoais->site ?? old('site') }}">
                    @error('site')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                  <div class="col-sm-10">
                    <input type="mail" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                      id="email" name="email" placeholder="Site"
                      value="{{ $user->dados_pessoais->email ?? old('E-mail') }}">
                    @error('email')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox" class="icheck-primary">
                      <label>
                        <input type="checkbox" id="aceite" class=""> Declaro que todas as informações informada são verdadeiras</a>
                      </label>
                    </div>
                  </div>
                </div>           

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-lg align-middle" id="submitBtn" data-toggle="tooltip" data-placement="top"
                    title="Salvar registro">Salvar</button></div>
                </div>
              </form>
            </div>

            <div class="tab-pane" id="timeline">

   
           <form action="{{route('users.perfil.storeDocumentos')}}" method="POST" enctype="multipart/form-data" id="my-dropzone" class="dropzone">
                @csrf
            </form>
        
                
                
            </div>

          </div>

        </div>
      </div>

    </div>

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
    //aplica as mascara
      $(document).ready(function(){
      $(":input").inputmask();
      });

    document.addEventListener('DOMContentLoaded', function () {
      var tipoPessoa = document.getElementById('tipo_pessoa');
      var cnpjInput = document.getElementById('cnpj');
      var navLinks = document.querySelectorAll('.nav-link');

     function applyMask() {
        var mask = (tipoPessoa.value === 'F') ? '999.999.999-99' : '99.999.999/9999-99';
        $(cnpjInput).inputmask('remove'); // Remove qualquer máscara existente
        $(cnpjInput).inputmask({ mask: mask });      }

    // Aplica a máscara inicial com base no valor do select
      applyMask();
    // Adiciona um ouvinte de evento para alterar a máscara quando o valor do select mudar
      tipoPessoa.addEventListener('change', applyMask);



      // codigo das para as abas permanecerem abertas
    navLinks.forEach(function (navLink) {
      navLink.addEventListener('click', function () {
        localStorage.setItem('activeTab', this.getAttribute('href'));
      });
    });

    // Recupera a aba ativa do localStorage
    var activeTab = localStorage.getItem('activeTab');

    // Se houver uma aba ativa salva, ativa-a
    if (activeTab) {
      document.querySelector('.nav-link.active').classList.remove('active');
      document.querySelector('.tab-pane.active').classList.remove('active');

      document.querySelector('.nav-link[href="' + activeTab + '"]').classList.add('active');
      document.querySelector(activeTab).classList.add('active');
    }else{
      document.querySelector('.nav-link[href="#activity"]').classList.add('active');
      document.querySelector('#activity').classList.add('active');
    }
  });


  // document.getElementById('dadosPessoa').addEventListener('submit', function (event) {
  //   var checkbox = document.getElementById('aceite');

  //   if (!checkbox.checked) {
  //     event.preventDefault(); // Impede a submissão do formulário
  //     alert('Você deve marcar o checkbox antes de submeter o formulário.');
  //   }
  // });

  // Função para habilitar/desabilitar o botão de submit
  var submitBtn = document.getElementById('submitBtn');
    var aceiteCheckbox = document.getElementById('aceite');

  function toggleSubmitButton() {
      if (aceiteCheckbox.checked) {
        submitBtn.disabled = false;
      } else {
        submitBtn.disabled = true;
      }
    }
    // Adiciona um ouvinte de eventos ao checkbox para verificar quando seu estado muda
    aceiteCheckbox.addEventListener('change', toggleSubmitButton);
    // Verifica o estado inicial do checkbox
    toggleSubmitButton();
    // Adiciona um ouvinte de eventos ao botão de submit para verificar o estado do checkbox
    submitBtn.addEventListener('click', function (event) {
      if (!aceiteCheckbox.checked) {
        event.preventDefault();  // Impede o envio do formulário
        Swal.fire("Por favor, marque o campo de declaração para continuar.");        
      }
    });

    Dropzone.options.myDropzone = {
        thumbnailWidth:400,
        maxFilesize:2,
        acceptedFiles:"jpeg,.jpf,.png,.gif,.pdf"
  };
    
  //   new myDropzone("#image-upload", {
  //   thumbnailWidth:200,
  //   maxFilesize:1,
  //   acceptedFiles:"jpeg,.jpf,.png,.gif"

  // })

</script>
@stop