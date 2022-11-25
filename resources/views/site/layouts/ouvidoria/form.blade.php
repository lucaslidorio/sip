<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="author" content="Grayrids">
  {{-- @foreach ($tenants as $tenant)
  @endforeach --}}

  <title>{{ $cliente->nome }}</title>


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{ url('../site/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/line-icons.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/owl.carousel.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/owl.theme.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/nivo-lightbox.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/magnific-popup.cs') }}s">
  <link rel="stylesheet" href="{{ url('../site/css/animate.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/menu_sideslide.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/main.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/responsive.css') }}">
  <link rel="stylesheet" href="{{ url('../site/css/lc_lightbox.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
    integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Color CSS Styles  -->
  <link rel="stylesheet" type="text/css" href="{{ url('../site/css/colors/preset.css') }}" media="screen" />

</head>

<body class="container-fluid">
  @include('site.layouts.includes.menuExterno')


  <section id="contato" class="section">
    <br><br>
    <div class="contact-form">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-9">
            <div class="contact-block">
              <div class="section-header">
                <h2 class="section-title">Ouvidoria - Registrar <span>{{$tipo_ouvidoria->nome}} </span></h2>
                <hr class="lines">
              </div>
              <form id="" action="{{route('contato.enviar')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="anonimo" class="label-required">Anônimo: <span class="text-danger">*</span></label>
                      <select class="custom-select {{ $errors->has('anonimo') ? 'is-invalid' : '' }}" id="anonimo"
                        name="anonimo">
                        <option value="0"> Não </option>
                        <option value="1"> Sim </option>
                      </select>
                      @error('anonimo')
                      <small class="invalid-feedback">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="sigiloso" class="label-required">Manter Sigilo:<span
                          class="text-danger">*</span></label>
                      <select class="custom-select {{ $errors->has('sigiloso') ? 'is-invalid' : '' }}" id="sigiloso"
                        name="sigiloso">
                        <option value="0"> Não </option>
                        <option value="1"> Sim </option>
                      </select>
                      @error('sigiloso')
                      <small class="invalid-feedback">
                        {{ $message }}
                      </small>
                      @enderror
                    </div>
                  </div>
                </div>

                <div id="ocultar" class="p-0 m-0">
                  <h6 class="border-bottom">Dados Pessoais</h6>
                  
                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group">
                        <label for="nome" class="label-required">Nome</label>
                        <input type="text" class="form-control  {{ $errors->has('nome') ? 'is-invalid' : '' }}"
                          id="nome" name="nome" placeholder="Nome do parlamentar" value="">
                        @error('nome')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror

                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf"
                          name="cpf" placeholder="cpf" value="">
                        @error('cpf')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="e-mail" class="label-required">E-Mail:</label>
                        <input type="mail" class="form-control  {{ $errors->has('e-mail') ? 'is-invalid' : '' }}"
                          id="e-mail" name="e-mail" placeholder="e-mail " value="">
                        @error('e-mail')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror

                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="telefone" class="label-required">Telefone:</label>
                        <input type="tel" class="form-control  {{ $errors->has('telefone') ? 'is-invalid' : '' }}"
                          id="telefone" name="telefone" placeholder="Telefone " value="">
                        @error('telefone')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror

                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label for="celular" class="label-required">Celular:</label>
                        <input type="tel" class="form-control  {{ $errors->has('celular') ? 'is-invalid' : '' }}"
                          id="celular" name="celular" placeholder="Celular " value="">
                        @error('celular')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="endereco" class="label-required">Endereço:</label>
                        <input type="text" class="form-control  {{ $errors->has('endereco') ? 'is-invalid' : '' }}"
                          id="endereco" name="endereco" placeholder="Endereco " value="">
                        @error('endereco')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror

                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="numero_endereco" class="label-required">Número:</label>
                        <input type="text"
                          class="form-control  {{ $errors->has('numero_endereco') ? 'is-invalid' : '' }}"
                          id="numero_endereco" name="numero_endereco" placeholder=" " value="">
                        @error('numero_endereco')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror

                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="bairro" class="label-required">Bairro:</label>
                        <input type="text" class="form-control  {{ $errors->has('bairro') ? 'is-invalid' : '' }}"
                          id="bairro" name="bairro" placeholder="Bairro " value="">
                        @error('bairro')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="municipio" class="label-required">Cidade:</label>
                        <input type="text" class="form-control  {{ $errors->has('municipio') ? 'is-invalid' : '' }}"
                          id="municipio" name="municipio" placeholder="Municipio, distrito " value="">
                        @error('municipio')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="uf" class="label-required">UF:</label>
                        <input type="text" class="form-control  {{ $errors->has('uf') ? 'is-invalid' : '' }}" id="uf"
                          name="uf" placeholder=" " value="">
                        @error('uf')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="cep" class="label-required">CEP:</label>
                        <input type="tel" class="form-control  {{ $errors->has('cep') ? 'is-invalid' : '' }}" id="cep"
                          name="cep" placeholder=" " value="">
                        @error('cep')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="complemento" class="label-required">Complemento:</label>
                        <input type="text" class="form-control  {{ $errors->has('complemento') ? 'is-invalid' : '' }}"
                          id="complemento" name="complemento" placeholder="Complemento do endereço " value="">
                        @error('complemento')
                        <small class="invalid-feedback">
                          {{ $message }}
                        </small>
                        @enderror
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="row">

                    <div class="submit-button text-center">
                      <button class="btn btn-common" id="submit" type="submit">Enviar</button>
                      <div id="msgSubmit" class="h3 text-center hidden"></div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>

  </section>
</body>

<script>
  function ocultaCampo()
         {  
          var anonimo = document.getElementById('anonimo').value;        
          if(anonimo == 1){         
           document.getElementById("ocultar").style.display = 'none';         
            
          }else{
            document.getElementById("ocultar").style.display = '';
          }
      }
         document.getElementById("anonimo").onchange = function() {ocultaCampo()};
        
</script>