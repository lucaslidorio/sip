@extends('public_templates.leg.default')

@section('content')
{{-- {{ Breadcrumbs::render('ouvidora_tipo', $tipo_ouvidoria) }}  --}}

<div class="container">
  <h2 class="mb-4">OUVIDORIA</h2>

  <div class="card mb-3" >
    <div class="card-header cor-padrao-bg" >
        <h5 class="card-title text-white fs-3">Registrar {{$tipo_ouvidoria->nome}}</h5>
    </div>
    <div class="card-body">
      <form id="" action="{{route('ouvidoria.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="tipo_id" value="{{$tipo_ouvidoria->id}}">
        <div class="row">
          <div class="col-sm-4">      
              <label for="anonimo" class="form-label">Anônimo: <span class="text-danger">*</span></label>
              <select class="form-select form-select-lg mb-3 {{ $errors->has('anonimo') ? 'is-invalid' : '' }}" id="anonimo" name="anonimo">
                <option value="0"> Não </option>
                <option value="1"> Sim </option>
              </select>
              @error('anonimo')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror          
          </div>
          <div class="col-sm-4">           
              <label for="sigiloso" class="form-label">Manter Sigilo:<span class="text-danger">*</span></label>
              <select class="form-select form-select-lg mb-3 {{ $errors->has('sigiloso') ? 'is-invalid' : '' }}" id="sigiloso"
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
  
        <div id="ocultar" class="p-0 m-0">
          <h6 class="border-bottom  fw-bold fs-4 fs-4">Dados Pessoais</h6>
          <div class="row">
            <div class="col-md-8">
              <label for="nome" class="form-label">Nome</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" 
                       id="nome" name="nome" placeholder="Nome" 
                       aria-label="nome" aria-describedby="nome" value="{{ old('nome') }}">
              </div>
              @error('nome')
                <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-4">
              <label for="cpf" class="form-label">CPF</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" 
                       id="cpf" name="cpf" placeholder="CPF" 
                       aria-label="cpf" aria-describedby="cpf" value="{{ old('cpf') }}">
              </div>
              @error('cpf')
                <div class="invalid-feedback d-block">
                  {{ $message }}
                </div>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="email" class="form-label">E-Mail:</label>
              <div class="input-group input-group-lg">
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
              </div>
              @error('email')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-3">
              <label for="telefone" class="form-label">Telefone:</label>
              <div class="input-group input-group-lg">
                <input type="tel" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}" id="telefone" name="telefone" placeholder="Telefone" value="{{ old('telefone') }}">
              </div>
              @error('telefone')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-3">
              <label for="celular" class="form-label">Celular:</label>
              <div class="input-group input-group-lg">
                <input type="tel" class="form-control {{ $errors->has('celular') ? 'is-invalid' : '' }}" id="celular" name="celular" placeholder="Celular" value="{{ old('celular') }}">
              </div>
              @error('celular')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-md-6">
              <label for="endereco" class="form-label">Endereço:</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : '' }}" id="endereco" name="endereco" placeholder="Endereço" value="{{ old('endereco') }}">
              </div>
              @error('endereco')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-2">
              <label for="numero_endereco" class="form-label">Número:</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('numero_endereco') ? 'is-invalid' : '' }}" id="numero_endereco" name="numero_endereco" value="{{ old('numero_endereco') }}">
              </div>
              @error('numero_endereco')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-4">
              <label for="bairro" class="form-label">Bairro:</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('bairro') ? 'is-invalid' : '' }}" id="bairro" name="bairro" placeholder="Bairro" value="{{ old('bairro') }}">
              </div>
              @error('bairro')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-md-6">
              <label for="municipio" class="form-label">Cidade:</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('municipio') ? 'is-invalid' : '' }}" id="municipio" name="municipio" placeholder="Município, distrito" value="{{ old('municipio') }}">
              </div>
              @error('municipio')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-2">
              <label for="uf" class="form-label">UF:</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('uf') ? 'is-invalid' : '' }}" id="uf" name="uf" value="{{ old('uf') }}">
              </div>
              @error('uf')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-4">
              <label for="cep" class="form-label">CEP:</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('cep') ? 'is-invalid' : '' }}" id="cep" name="cep" value="{{ old('cep') }}">
              </div>
              @error('cep')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-md-12">
              <label for="complemento" class="form-label">Complemento:</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('complemento') ? 'is-invalid' : '' }}" id="complemento" name="complemento" placeholder="Complemento do endereço" value="{{ old('complemento') }}">
              </div>
              @error('complemento')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
          



     


          <div class="row mt-4">
            <div class="col-md-4">
              <label for="genero" class="form-label">Gênero: <span class="text-danger">*</span></label>
              <select class="form-select  form-select-lg {{ $errors->has('genero') ? 'is-invalid' : '' }}" id="genero" name="genero">
                <option value="">SELECIONE</option>
                <option value="1" {{ old('genero') == '1' ? 'selected' : '' }}>MASCULINO</option>
                <option value="2" {{ old('genero') == '2' ? 'selected' : '' }}>FEMININO</option>
              </select>
              @error('genero')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-4">
              <label for="perfil_ouvidoria_id" class="form-label">Perfil:</label>
              <select class="form-select form-select-lg select2 {{ $errors->has('perfil_ouvidoria_id') ? 'is-invalid' : '' }}" name="perfil_ouvidoria_id" style="width: 100%;">
                <option value="" selected>NÃO INFORMADO</option>
                @foreach ($perfis_ouvidoria as $perfil)
                <option value="{{$perfil->id}}" {{ old('perfil_ouvidoria_id') == $perfil->id ? 'selected' : '' }}>{{$perfil->nome}}</option>
                @endforeach
              </select>
              @error('perfil_ouvidoria_id')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          

            <div class="col-md-2">
              <label for="idade" class="form-label">Idade:</label>
              <div class="input-group input-group-lg">
                <input type="text" class="form-control {{ $errors->has('idade') ? 'is-invalid' : '' }}" id="idade" name="idade" value="{{ old('idade') }}">
              </div>
             @error('idade')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-2">
              <label for="quant_filhos" class="form-label">Quant. Filhos:</label>
              <div class="input-group input-group-lg">
               <input type="text" class="form-control {{ $errors->has('quant_filhos') ? 'is-invalid' : '' }}" id="quant_filhos" name="quant_filhos" value="{{ old('quant_filhos') }}">
              </div>
               @error('quant_filhos')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-md-4">
              <label for="estado_civil" class="form-label">Estado Civil: <span class="text-danger">*</span></label>
              <select class="form-select form-select-lg  {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}" id="estado_civil" name="estado_civil">
                <option value="0">NÃO INFORMADO</option>
                <option value="1" {{ old('estado_civil') == '1' ? 'selected' : '' }}>SOLTEIRO(a)</option>
                <option value="2" {{ old('estado_civil') == '2' ? 'selected' : '' }}>CASADO(a)</option>
                <option value="3" {{ old('estado_civil') == '3' ? 'selected' : '' }}>DIVORCIADO(a) OU SEPARADO(a)</option>
                <option value="4" {{ old('estado_civil') == '4' ? 'selected' : '' }}>UNIÃO ESTÁVEL</option>
                <option value="5" {{ old('estado_civil') == '5' ? 'selected' : '' }}>VIÚVO(a)</option>
              </select>
              @error('estado_civil')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-4">
              <label for="ocupacao" class="form-label">Ocupação: <span class="text-danger">*</span></label>
              <select class="form-select form-select-lg {{ $errors->has('ocupacao') ? 'is-invalid' : '' }}" id="ocupacao" name="ocupacao">
                <option value="0">NÃO INFORMADO</option>
                <option value="1" {{ old('ocupacao') == '1' ? 'selected' : '' }}>TRABALHA NO SETOR PÚBLICO</option>
                <option value="2" {{ old('ocupacao') == '2' ? 'selected' : '' }}>TRABALHA NO SETOR PRIVADO</option>
                <option value="3" {{ old('ocupacao') == '3' ? 'selected' : '' }}>TRABALHA NO SETOR INFORMAL</option>
                <option value="4" {{ old('ocupacao') == '4' ? 'selected' : '' }}>DO LAR</option>
                <option value="5" {{ old('ocupacao') == '5' ? 'selected' : '' }}>DESEMPREGADO</option>
                <option value="6" {{ old('ocupacao') == '6' ? 'selected' : '' }}>APOSENTADO</option>
                <option value="7" {{ old('ocupacao') == '7' ? 'selected' : '' }}>OUTROS</option>
              </select>
              @error('ocupacao')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        <div>
          <div class="mt-5 border-bottom pb-2">
            <h6 class="fw-bold fs-4">Dados da Manifestação</h6>
          </div>
          
          <div class="row mt-3">
            <div class="col-md-6">
              <label for="orgao_ouvidoria_id" class="form-label">Órgão: <span class="text-danger">*</span></label>
              <select class="form-select form-select-lg select2 {{ $errors->has('orgao_ouvidoria_id') ? 'is-invalid' : '' }}" name="orgao_ouvidoria_id" style="width: 100%;">
                <option value="" selected>Selecione</option>
                @foreach ($orgaos_ouvidoria as $orgao)
                <option value="{{$orgao->id}}" {{ old('orgao_ouvidoria_id') == $orgao->id ? 'selected' : '' }}>{{$orgao->nome}}</option>
                @endforeach
              </select>
              @error('orgao_ouvidoria_id')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          
            <div class="col-md-6">
              <label for="assunto_ouvidoria_id" class="form-label">Assunto: <span class="text-danger">*</span></label>
              <select class="form-select form-select-lg select2 {{ $errors->has('assunto_ouvidoria_id') ? 'is-invalid' : '' }}" name="assunto_ouvidoria_id" style="width: 100%;">
                @foreach ($assuntos_ouvidoria as $assunto)
                <option value="{{$assunto->id}}" {{ old('assunto_ouvidoria_id') == $assunto->id ? 'selected' : '' }}>{{$assunto->nome}}</option>
                @endforeach
              </select>
              @error('assunto_ouvidoria_id')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-md-12">
              <label for="manifestacao" class="form-label">Manifestação: <span class="text-danger">*</span></label>
              <div class="input-group input-group-lg">
                <textarea class="form-control {{ $errors->has('manifestacao') ? 'is-invalid' : '' }}" name="manifestacao" id="manifestacao" rows="3" placeholder="Deixe aqui sua manifestação.">{{ old('manifestacao') }}</textarea>
              </div>
              @error('manifestacao')
              <div class="invalid-feedback d-block">{{ $message }}</div>
              @enderror
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-md-12">
              <label for="anexo" class="form-label">Anexo</label>
              <div class="input-group input-group-lg">
                <input type="file" class="form-control" id="anexo" name="anexo[]" multiple>
              </div>              
              <small class="form-text text-muted">Tamanho máximo do anexo: 10 MB</small>
            </div>
          </div>
          
          <div class="row mt-4">
            <div class="col-md-12 text-center">
              <button class="btn btn-lg btn-primary  cor-padrao-bg text-white mt-3 fs-3" id="submit" type="submit">Enviar</button>
            </div>
          </div>           
        </div>
    </div>
    </form>
    </div>
  </div>

</div>











<div class="row">
    <h4 class="font-blue text-uppercase"></h4>

  <div class="col-12">
   
</div>
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
@endsection
