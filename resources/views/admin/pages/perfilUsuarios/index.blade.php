@extends('adminlte::page')
@section('title', 'Categorias')
@section('content_header')
@section('plugins.Sweetalert2', true)
@section('plugins.inputmask', true)
@include('sweetalert::alert')
@section('plugins.icheck-bootstrap', true)
@section('plugins.dropzone', true)
{{-- <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script> --}}
{{--
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> --}}

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
           
            <img class="profile-user-img img-fluid img-circle" src="{{$user->profile_image_url}}"
              alt="Imagem de perfil do usuario">
           
          </div>

                           
                      
                 
          <h3 class="profile-username text-center">{{$user->name}}</h3>
          <p class="text-muted text-center">{{ $user->dadosPessoais->razao_social ?? 'Não Informado' }}</p>
          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Credenciamentos Ativos</b> <a class="float-right">{{$user->dadosPessoais->countCredenciamentosAtivo()}}</a>
            </li>
            <li class="list-group-item">
              <b>Total de Participações</b> <a class="float-right">{{$user->dadosPessoais->countCredenciamentos()}}</a>
            </li>
            <li class="list-group-item">
              <b>Descredenciado</b> <a class="float-right text-danger">{{$user->dadosPessoais->countDescredenciado()}}</a>
            </li>
          </ul>          
        </div>
      </div>


      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Sobre</h3>
        </div>

        <div class="card-body">
          <strong><i class="fas fa-phone-alt mr-1"></i> Contato</strong>
          <p class="text-muted">
            <strong>Email: </strong>{{ $user->dadosPessoais->email ?? 'Não Informado' }} <br>
            <strong>Telefone: </strong>{{ $user->dadosPessoais->telefone ?? 'Não Informado' }} <br>
            <strong>Celular: </strong>{{ $user->dadosPessoais->celular ?? 'Não Informado' }} <br>
            <strong>Site: </strong>{{ $user->dadosPessoais->site ?? 'Não Informado' }}

          </p>
          <hr>
          <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço</strong>
          <p class="text-muted">
            {{ $user->dadosPessoais->endereco ?? 'Não Informado' }} ,
            {{ $user->dadosPessoais->numero ?? 'Não Informado' }},
            {{ $user->dadosPessoais->bairro ?? 'Não Informado' }},
            {{ $user->dadosPessoais->cidade ?? 'Não Informado' }},
            {{ $user->dadosPessoais->estado ?? 'Não Informado' }},
            {{ $user->dadosPessoais->cep ?? 'Não Informado' }}
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
                  <img class="img-circle img-bordered-sm" src="{{$user->profile_image_url}}" alt="imagem do perfil">
                  <span class="username">
                    <a href="#">{{ $user->dadosPessoais->nome_fantasia ?? 'Informado' }}</a> </span>
                  <span class="description">{{ $user->dadosPessoais->razao_social ?? 'Não Informado' }}</span>


                  <div class="card mt-3">
                    <div class="card-header">
                      <h5><i class="fas fa-database "></i> Meus Dados</h5>
                    </div>
                    <div class="card-body">
                      <div class=" " style="padding-left: 15px">
                        <p class="card-text"><strong>Tipo de Pessoa: </strong>{{ $user->dadosPessoais->tipo_pessoa ??
                          'Não Informado' }}</p>
                        <p class="card-text"><strong>Natureza Jurídica: </strong>{{
                          $user->dadosPessoais->natureza_juridica ?? 'Não Informado' }}</p>
                        <p class="card-text"><strong>Natureza Jurídica: </strong>{{
                          $user->dadosPessoais->natureza_juridica ?? 'Não Informado' }}</p>
                        <p class="card-text"><strong>Enquadramento: </strong>{{ $user->dadosPessoais->enquadramento ??
                          'Não Informado' }}</p>
                        <p class="card-text"><strong>Razão Social: </strong>{{ $user->dadosPessoais->razao_social ??
                          'Não
                          Informado' }}</p>
                        <p class="card-text"><strong>CNPJ: </strong>{{ $user->dadosPessoais->cnpj ?? 'Não Informado' }}
                        </p>
                        <p class="card-text"><strong>Insc. Estadual: </strong>{{
                          $user->dadosPessoais->inscricao_estadual
                          ?? 'Não Informado' }}</p>
                        <p class="card-text"><strong>Data de Abertura : </strong>
                          <td>{{ !empty($user->dadosPessoais->data_abertura) ?
                            Carbon\Carbon::parse($user->dadosPessoais->data_abertura)->format('d/m/Y') : '-' }}</td>
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
                        <div class="row">
                          @foreach($user->dadosPessoais->documentosPessoas as $index => $documento)
                              <div class="col-md-4 mb-4">
                                  <a href="{{ config('app.aws_url')."{$documento->anexo}" }}"
                                     target="_blank" class="mb-2 text-reset"
                                     data-toggle="tooltip" data-placement="top"
                                     title="Clique para abrir o documento">
                                     <i class="far fa-file-pdf fa-3x text-danger mr-2"></i>
                                     <span class="mr-2"> {{$documento->nome_original}}</span><br>                                     
                                  </a>                                  
                              </div>
                          @endforeach
                      </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>


            <div class="tab-pane" id="settings">
              <form class="form-horizontal" id="dadosPessoa" action="{{route('users.perfil.store', $user->id)}}"
                method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="user_id" value="{{$user->id}}">
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label label-required">Tipo de Pessoa</label>
                  <div class="col-sm-10">
                    <select class="custom-select {{ $errors->has('tipo_pessoa') ? 'is-invalid' : '' }}" id="tipo_pessoa"
                      name="tipo_pessoa">
                      <option value="">Selecione uma opção</option>
                      <option value="F" {{isset($user) && $user->dadosPessoais->tipo_pessoa == 'F' ? 'selected': ''}}>
                        Fisíca
                      </option>
                      <option value="J" {{isset($user) && $user->dadosPessoais->tipo_pessoa == 'J' ? 'selected': ''}}>
                        Jurídica </option>
                    </select>
                    @error('tipo_pessoa')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label ">Natureza Jurídica</label>
                  <div class="col-sm-10">
                    <select class="custom-select {{ $errors->has('natureza_juridica') ? 'is-invalid' : '' }}"
                      id="natureza_juridica" name="natureza_juridica">
                      <option value="" selected>Selecione uma opção</option>
                      <option value="EI" {{isset($user) && $user->dadosPessoais->natureza_juridica == 'EI' ?
                        'selected': ''}}> EI
                      </option>
                      <option value="LTDA" {{isset($user) && $user->dadosPessoais->natureza_juridica == 'LTDA' ?
                        'selected': ''}}> LTDA
                      </option>
                      <option value="SA" {{isset($user) && $user->dadosPessoais->natureza_juridica == 'SA' ?
                        'selected': ''}}> SA
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
                  <label for="enquadramento" class="col-sm-2 col-form-label ">Enquadramento</label>
                  <div class="col-sm-10">
                    <select class="custom-select {{ $errors->has('enquadramento') ? 'is-invalid' : '' }}"
                      id="enquadramento" name="enquadramento">
                      <option value="" selected>Selecione uma opção</option>
                      <option value="MIC" {{ isset($user) && $user->dadosPessoais->enquadramento == 'MIC' ? 'selected':
                        '' }}>Micro
                        Empresa (MIC)</option>
                      <option value="EPP" {{ isset($user) && $user->dadosPessoais->enquadramento == 'EPP' ? 'selected':
                        '' }}>Empresa
                        de Pequeno Porte (EPP)</option>
                      <option value="GP" {{ isset($user) && $user->dadosPessoais->enquadramento == 'GP' ? 'selected':
                        '' }}>Grande
                        Porte (GP)</option>
                      <option value="DE" {{ isset($user) && $user->dadosPessoais->enquadramento == 'DE' ? 'selected':
                        '' }}>Demais
                        Empresas (DE)</option>
                      <option value="COOP" {{ isset($user) && $user->dadosPessoais->enquadramento == 'COOP' ?
                        'selected': ''
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
                  <label for="nome_fantasia" class="col-sm-2 col-form-label  ">Nome Fantasia
                  </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control {{ $errors->has('nome_fantasia') ? 'is-invalid' : '' }}"
                      id="nome_fantasia" name="nome_fantasia" placeholder="Nome fantasia"
                      value="{{$user->dadosPessoais->nome_fantasia}}">
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
                      value="{{ $user->dadosPessoais->razao_social ?? old('razao_social') }}">
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
                    <input type="text" class="form-control {{ $errors->has('cnpj') ? 'is-invalid' : '' }}" id="cnpj"
                      name="cnpj" placeholder="Cnpj ou cpf" value="{{ $user->dadosPessoais->cnpj ?? old('cnpj') }}">
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
                    <input type="text"
                      class="form-control {{ $errors->has('inscricao_estadual') ? 'is-invalid' : '' }}"
                      id="inscricao_estadual" name="inscricao_estadual" placeholder="Inscrição estadual"
                      value="{{ $user->dadosPessoais->inscricao_estadual ?? old('inscricao_estadual') }}">
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
                      value="{{ $user->dadosPessoais->data_abertura ?? old('data_abertura') }}">
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
                      value="{{ $user->dadosPessoais->endereco ?? old('endereco') }}">
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
                    <input type="text" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" id="numero"
                      name="numero" placeholder="Número" maxlength="6"
                      value="{{ $user->dadosPessoais->numero ?? old('numero') }}">
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
                    <input type="text" class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" id="bairro"
                      name="bairro" placeholder="Bairro" value="{{ $user->dadosPessoais->bairro ?? old('bairro') }}">
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
                    <input type="text" class="form-control {{ $errors->has('cidade') ? 'is-invalid' : '' }}" id="cidade"
                      name="cidade" placeholder="Cidade" value="{{ $user->dadosPessoais->cidade ?? old('cidade') }}">
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
                    <input type="text" class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}" id="cep"
                      name="cep" placeholder="Cep" value="{{ $user->dadosPessoais->cep ?? old('cep') }}">
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
                    <select class="custom-select {{ $errors->has('estado') ? 'is-invalid' : '' }}" id="estado"
                      name="estado">
                      <option value="" selected>Selecione uma opção</option>
                      <option value="">Selecione um estado</option>
                      <option value="AC" {{ isset($user) && $user->dadosPessoais->estado == 'AC' ? 'selected' : ''
                        }}>Acre</option>
                      <option value="AL" {{ isset($user) && $user->dadosPessoais->estado == 'AL' ? 'selected' : ''
                        }}>Alagoas</option>
                      <option value="AP" {{ isset($user) && $user->dadosPessoais->estado == 'AP' ? 'selected' : ''
                        }}>Amapá</option>
                      <option value="AM" {{ isset($user) && $user->dadosPessoais->estado == 'AM' ? 'selected' : ''
                        }}>Amazonas</option>
                      <option value="BA" {{ isset($user) && $user->dadosPessoais->estado == 'BA' ? 'selected' : ''
                        }}>Bahia</option>
                      <option value="CE" {{ isset($user) && $user->dadosPessoais->estado == 'CE' ? 'selected' : ''
                        }}>Ceará</option>
                      <option value="DF" {{ isset($user) && $user->dadosPessoais->estado == 'DF' ? 'selected' : ''
                        }}>Distrito Federal</option>
                      <option value="ES" {{ isset($user) && $user->dadosPessoais->estado == 'ES' ? 'selected' : ''
                        }}>Espírito Santo</option>
                      <option value="GO" {{ isset($user) && $user->dadosPessoais->estado == 'GO' ? 'selected' : ''
                        }}>Goiás</option>
                      <option value="MA" {{ isset($user) && $user->dadosPessoais->estado == 'MA' ? 'selected' : ''
                        }}>Maranhão</option>
                      <option value="MT" {{ isset($user) && $user->dadosPessoais->estado == 'MT' ? 'selected' : ''
                        }}>Mato Grosso</option>
                      <option value="MS" {{ isset($user) && $user->dadosPessoais->estado == 'MS' ? 'selected' : ''
                        }}>Mato Grosso do Sul</option>
                      <option value="MG" {{ isset($user) && $user->dadosPessoais->estado == 'MG' ? 'selected' : ''
                        }}>Minas Gerais</option>
                      <option value="PA" {{ isset($user) && $user->dadosPessoais->estado == 'PA' ? 'selected' : ''
                        }}>Pará</option>
                      <option value="PB" {{ isset($user) && $user->dadosPessoais->estado == 'PB' ? 'selected' : ''
                        }}>Paraíba</option>
                      <option value="PR" {{ isset($user) && $user->dadosPessoais->estado == 'PR' ? 'selected' : ''
                        }}>Paraná</option>
                      <option value="PE" {{ isset($user) && $user->dadosPessoais->estado == 'PE' ? 'selected' : ''
                        }}>Pernambuco</option>
                      <option value="PI" {{ isset($user) && $user->dadosPessoais->estado == 'PI' ? 'selected' : ''
                        }}>Piauí</option>
                      <option value="RJ" {{ isset($user) && $user->dadosPessoais->estado == 'RJ' ? 'selected' : ''
                        }}>Rio de Janeiro</option>
                      <option value="RN" {{ isset($user) && $user->dadosPessoais->estado == 'RN' ? 'selected' : ''
                        }}>Rio Grande do Norte</option>
                      <option value="RS" {{ isset($user) && $user->dadosPessoais->estado == 'RS' ? 'selected' : ''
                        }}>Rio Grande do Sul</option>
                      <option value="RO" {{ isset($user) && $user->dadosPessoais->estado == 'RO' ? 'selected' : ''
                        }}>Rondônia</option>
                      <option value="RR" {{ isset($user) && $user->dadosPessoais->estado == 'RR' ? 'selected' : ''
                        }}>Roraima</option>
                      <option value="SC" {{ isset($user) && $user->dadosPessoais->estado == 'SC' ? 'selected' : ''
                        }}>Santa Catarina</option>
                      <option value="SP" {{ isset($user) && $user->dadosPessoais->estado == 'SP' ? 'selected' : ''
                        }}>São Paulo</option>
                      <option value="SE" {{ isset($user) && $user->dadosPessoais->estado == 'SE' ? 'selected' : ''
                        }}>Sergipe</option>
                      <option value="TO" {{ isset($user) && $user->dadosPessoais->estado == 'TO' ? 'selected' : ''
                        }}>Tocantins</option>
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
                    <input type="text" data-inputmask="'mask': '(99) 9999-9999'"
                      class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}" id="telefone"
                      name="telefone" placeholder="Telefone"
                      value="{{ $user->dadosPessoais->telefone ?? old('telefone') }}">
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
                    <input type="text" data-inputmask="'mask': '(99) 999999999'"
                      class="form-control {{ $errors->has('celular') ? 'is-invalid' : '' }}" id="celular" name="celular"
                      placeholder="Celular" value="{{ $user->dadosPessoais->celular ?? old('celular') }}">
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
                    <input type="text" class="form-control {{ $errors->has('site') ? 'is-invalid' : '' }}" id="site"
                      name="site" placeholder="Site" value="{{ $user->dadosPessoais->site ?? old('site') }}">
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
                    <input type="mail" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                      name="email" placeholder="Site" value="{{ $user->dadosPessoais->email ?? old('E-mail') }}">
                    @error('email')
                    <small class="invalid-feedback">
                      {{ $message }}
                    </small>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">                  
                  <label for="img" class="col-sm-2 col-form-label">Foto ou Logomarca:</label>
                  <div class="col-sm-10">
                    {{-- @isset($user)                    
                        <img src="{{config('app.aws_url')."{$user->dadosPessoais->img}" }}"" alt="{{$user->dadosPessoais->nome}}" style="max-width: 200px; padding-bottom: 20px">
                    @endisset       --}}
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                          </div> 
                      <input type="file" class="form-control {{ $errors->has('img') ? 'is-invalid' : '' }}" id="img"
                          name="img" placeholder="Nenhuma imagem selecionada" value="{{ $user->dadosPessoais->img ?? old('img') }}">
                      @error('img')
                          <small class="invalid-feedback">
                              {{ $message }}
                          </small>
                      @enderror
                    </div>
                    <span class="text-danger">Dimensões recomendada 256 x 256, ultilize o site <a target="_" href="https://www.iloveimg.com/pt/redimensionar-imagem">Iloveimg</a>  para redimensionar</span>
                    
                  </div>
                
              </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox" class="icheck-primary">
                      <label>
                        <input type="checkbox" id="aceite" class=""> Declaro que todas as informações informada são
                        verdadeiras</a>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-primary btn-lg align-middle" id="submitBtn"
                      data-toggle="tooltip" data-placement="top" title="Salvar registro">Salvar</button>
                  </div>
                </div>
              </form>
            </div>

            <div class="tab-pane" id="timeline">


              {{-- <form action="{{route('users.perfil.storeDocumentos')}}" method="POST" enctype="multipart/form-data"
                id="my-dropzone" class="dropzone">
                @csrf
              </form> --}}

              <div class="row">
                <div class="col-md-12">
                  <div class="card card-default">
                    <div class="card-header">
                      <h3 class="card-title"><i class="far fa-folder"></i> Documentos</h3>
                    </div>
                    <div class="card-body">
                      <div id="actions" class="row">
                        @csrf
                        <div class="col-lg-6">
                          <div class="btn-group w-100">
                            <span class="btn btn-success col fileinput-button">
                              <i class="fas fa-plus"></i>
                              <span>Adicionar Documentos</span>
                            </span>
                            <button type="submit" class="btn btn-primary col start">
                              <i class="fas fa-upload"></i>
                              <span>Enviar Todos</span>
                            </button>
                            <button type="reset" class="btn btn-warning col cancel">
                              <i class="fas fa-times-circle"></i>
                              <span>Cancelar</span>
                            </button>
                          </div>
                        </div>
                        <div class="col-lg-6 d-flex align-items-center">
                          <div class="fileupload-process w-100">
                            <div id="total-progress" class="progress progress-striped active" role="progressbar"
                              aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>
                                <span class="total-progress-text">0%</span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="table table-striped files" id="previews">
                        <div id="template" class="row mt-2">
                          <div class="col-auto">
                            <span class="preview"><img src="data:," alt data-dz-thumbnail /></span>
                          </div>
                          <div class="col d-flex align-items-center">
                            <p class="mb-0">
                              <span class="lead" data-dz-name></span>
                              (<span data-dz-size></span>)
                            </p>
                            <strong class="error text-danger" data-dz-errormessage></strong>
                          </div>

                          <div class="col-4 d-flex align-items-center">
                            <div id="unique-progress" class="progress progress-striped active w-100" role="progressbar"
                              aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>
                                <span class="progress-text">0%</span>
                              </div>
                            </div>
                          </div>

                          <div class="col-auto d-flex align-items-center">
                            <div class="btn-group">
                              <button class="btn btn-primary start">
                                <i class="fas fa-upload"></i>
                                <span>Iniciar</span>
                              </button>
                              <button data-dz-remove class="btn btn-warning cancel">
                                <i class="fas fa-times-circle"></i>
                                <span>Cancelar</span>
                              </button>
                              <button data-dz-remove class="btn btn-danger delete">
                                <i class="fas fa-trash"></i>
                                <span>Delete</span>
                              </button>
                            </div>
                          </div>                          
                            <div class="col-12 mt-2 border-bottom ">
                              <div class="row">
                              <div class="col-md-6 col-sm-6 col-xl-3">
                                <label for="type_document_id" class="label-required">Tipo do Documento:</label>
                                <select class="form-control" name="type_document_id" style="width: 100%;"
                                  data-dz-type-document>
                                  <option value="" selected>Selecione</option>
                                  @foreach ($type_documents as $type)
                                  <option value="{{ $type->id }}">{{ $type->nome }}</option>
                                  @endforeach
                                </select>
                                <small class="invalid-feedback"></small>
                              </div>
                              <di class="col-md-6 col-sm-6 col-xl-3">
                                <div class="form-group">
                                  <label for="data_validade">Data de Validade</label>
                                  <input type="date" class="form-control" name="data_validade" data-dz-validade>
                                </div>
                              </di>
                            </div>
                            </div>

                          

                          
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="card-footer">
                  </div>
                </div>


              </div>

              
                <div class="card mt-3">
                  <div class="card-header">
                    <h5><i class="fas fa-paper-plane "></i> Documentos Enviados</h5>
                  </div>
                  <div class="card-body">
                    <div class="timeline-body">                       
                      <div class="row">
                        @foreach($user->dadosPessoais->documentosPessoas as $index => $documento)
                            <div class="col-md-12 col-xl-6 mb-4">
                                <a href="{{ config('app.aws_url')."{$documento->anexo}" }}"
                                   target="_blank" class="mb-2 text-reset"
                                   data-toggle="tooltip" data-placement="top"
                                   title="Clique para abrir o documento">
                                   <i class="far fa-file-pdf fa-2x text-primary mr-2"></i>
                                   <span class="mr-2"> {{$documento->nome_original}}</span>                                     
                                </a>                                
                                <a href="{{route('users.perfil.deleteAttachment', $documento->id)}}" data-id="{{$documento->id}}"
                                  class="mb-2 text-reset" data-toggle="tooltip"  data-placement="top"
                                  title="Excluir Documento">
                                  <span class="fa-stack fa-1x text-danger mr-2">
                                      <i class="fas fa-square fa-stack-2x"></i>
                                      <i class="fa fa-trash-alt fa-stack-1x fa-inverse" ></i>
                                  </span>                    
                                </a>
                            </div>
                        @endforeach
                    </div>
                    </div>
                  </div>
                </div>

            </div>

          </div>
        </div>

      </div>

    </div>

  </div>






</div>
  @stop

  @section('js')
  @if(session('profile_incomplete'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Atualização Necessária',
                    text: 'Por favor, clique na aba editar dados e atualize seu perfil.',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                });
            });
        </script>
    @endif
  <script>
    //Inicia os tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })     
                
    //Aplica as mascara
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
        $(cnpjInput).inputmask({ mask: mask });      
      }

    // Aplica a máscara inicial com base no valor do select
      applyMask();
    // Adiciona um ouvinte de evento para alterar a máscara quando o valor do select mudar
      tipoPessoa.addEventListener('change', applyMask);


    // codigo das para as abas permanecerem abertas
    var navLinks = document.querySelectorAll('.nav-link');

    // Código para que as abas permaneçam abertas
    navLinks.forEach(function (navLink) {
      navLink.addEventListener('click', function () {
        localStorage.setItem('activeTab', this.getAttribute('href'));
      });
    });

    // Recupera a aba ativa do localStorage
    var activeTab = localStorage.getItem('activeTab');

    // Se houver uma aba ativa salva, ativa-a, caso contrário ativa a aba de id "activity"
    if (activeTab) {
      document.querySelector('.nav-link.active').classList.remove('active');
      document.querySelector('.tab-pane.active').classList.remove('active');

      document.querySelector('.nav-link[href="' + activeTab + '"]').classList.add('active');
      document.querySelector(activeTab).classList.add('active');
    } else {
      document.querySelector('.nav-link[href="#activity"]').classList.add('active');
      document.querySelector('#activity').classList.add('active');
    }
  });


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



 // Inícia o código do dropzone
Dropzone.autoDiscover = false;

// Get the template HTML and remove it from the document
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

// Get CSRF token
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "{{ route('users.perfil.storeDocumentos') }}", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,   
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
    acceptedFiles: "application/pdf", // Aceita apenas arquivos PDF
    headers: {
        "X-CSRF-TOKEN": csrfToken
    },
    init: function() {
        this.on("addedfile", function(file) {
            var startButton = file.previewElement.querySelector(".start");

            startButton.onclick = function() { 
                var typeDocumentId = file.previewElement.querySelector("[data-dz-type-document]").value;
                var selectElement = file.previewElement.querySelector("[data-dz-type-document]");
                var errorMessageElement = file.previewElement.querySelector(".invalid-feedback");
                
                if (!typeDocumentId) {
                    // Add the is-invalid class to the select element
                    selectElement.classList.add("is-invalid");
                    // Display an error message
                    errorMessageElement.textContent = "Por favor, selecione o tipo de documento.";
                } else {
                    selectElement.classList.remove("is-invalid");
                    errorMessageElement.textContent = "";
                    myDropzone.enqueueFile(file);
                }
            };
        });

        this.on("sending", function(file, xhr, formData) {
            var typeDocumentId = file.previewElement.querySelector("[data-dz-type-document]").value;
            var dataValidade = file.previewElement.querySelector("[data-dz-validade]").value;

            formData.append("type_document_id", typeDocumentId);
            formData.append("data_validade", dataValidade);
        });

        // Update the total progress bar
        this.on("totaluploadprogress", function(progress) {
            var progressBar = document.querySelector("#total-progress .progress-bar");
            //var progressText = progressBar.querySelector(".progress-text");
            var progressText = progressBar.querySelector(".total-progress-text");
            progressBar.style.width = progress + "%";
            progressText.textContent = Math.round(progress) + "%";
        });

        // Update the individual file progress bar
        this.on("uploadprogress", function(file, progress) {
            var progressBar = file.previewElement.querySelector(".progress-bar");
            var progressText = progressBar.querySelector(".progress-text");
            progressBar.style.width = progress + "%";
            progressText.textContent = Math.round(progress) + "%";
        });


        this.on("queuecomplete", function() {
            document.querySelector("#total-progress").style.opacity = "0";
        });

        document.querySelector("#actions .start").onclick = function() {
            var files = myDropzone.getFilesWithStatus(Dropzone.ADDED);
            files.forEach(function(file) {
                var typeDocumentId = file.previewElement.querySelector("[data-dz-type-document]").value;
                var selectElement = file.previewElement.querySelector("[data-dz-type-document]");
                var errorMessageElement = file.previewElement.querySelector(".invalid-feedback");

                if (!typeDocumentId) {
                    selectElement.classList.add("is-invalid");
                    errorMessageElement.textContent = "Por favor, selecione o tipo de documento.";
                } else {
                    selectElement.classList.remove("is-invalid");
                    errorMessageElement.textContent = "";
                    myDropzone.enqueueFile(file);

                     file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
                }
            });
        };

        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true);
        };

        this.on('error', function(file, response) {
            console.log('Erro ao carregar o arquivo');
            console.log(response);
            alert('Erro: ' + response.error);
        });
    }
});
  </script>
  @stop