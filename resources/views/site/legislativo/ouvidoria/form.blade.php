@extends('site.legislativo.layouts.default')

@section('content')
{{ Breadcrumbs::render('ouvidora_tipo', $tipo_ouvidoria) }} 
<div class="row">
  <h4 class="font-blue text-uppercase">OUVIDORIA - REGISTRAR {{$tipo_ouvidoria->nome}}</h4>

  <div class="col-12">
   <form id="" action="{{route('ouvidoria.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="tipo_id" value="{{$tipo_ouvidoria->id}}">
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label for="anonimo" class="form-label">Anônimo: <span class="text-danger">*</span></label>
            <select class="form-select {{ $errors->has('anonimo') ? 'is-invalid' : '' }}" id="anonimo" name="anonimo">
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
            <label for="sigiloso" class="form-label">Manter Sigilo:<span class="text-danger">*</span></label>
            <select class="form-select {{ $errors->has('sigiloso') ? 'is-invalid' : '' }}" id="sigiloso"
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
              <input type="text" class="form-control  {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                name="nome" placeholder="Nome" value="">
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
              <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf" name="cpf"
                placeholder="cpf" value="">
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
              <label for="email" class="label-required">E-Mail:</label>
              <input type="mail" class="form-control  {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                name="email" placeholder="email " value="">
              @error('email')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror

            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label for="telefone" class="label-required">Telefone:</label>
              <input type="tel" class="form-control  {{ $errors->has('telefone') ? 'is-invalid' : '' }}" id="telefone"
                name="telefone" placeholder="Telefone " value="">
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
              <input type="tel" class="form-control  {{ $errors->has('celular') ? 'is-invalid' : '' }}" id="celular"
                name="celular" placeholder="Celular " value="">
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
              <input type="text" class="form-control  {{ $errors->has('endereco') ? 'is-invalid' : '' }}" id="endereco"
                name="endereco" placeholder="Endereco " value="">
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
              <input type="text" class="form-control  {{ $errors->has('numero_endereco') ? 'is-invalid' : '' }}"
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
              <input type="text" class="form-control  {{ $errors->has('bairro') ? 'is-invalid' : '' }}" id="bairro"
                name="bairro" placeholder="Bairro " value="">
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
              <input type="text" class="form-control  {{ $errors->has('uf') ? 'is-invalid' : '' }}" id="uf" name="uf"
                placeholder=" " value="">
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
              <input type="tel" class="form-control  {{ $errors->has('cep') ? 'is-invalid' : '' }}" id="cep" name="cep"
                placeholder=" " value="">
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
        <h6 class="border-bottom"> </h6>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="genero" class="label-required form-label">Genero:<span class="text-danger">*</span></label>
              <select class="form-select {{ $errors->has('genero') ? 'is-invalid' : '' }}" id="genero" name="genero">
                <option value="1"> MASCULINO </option>
                <option value="2"> FEMININO </option>
              </select>
              @error('genero')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="perfil_ouvidoria_id" >Perfil:</label>
              <select class="form-select select2 {{ $errors->has('perfil_ouvidoria_id') ? 'is-invalid' : '' }}"
                name="perfil_ouvidoria_id" style="width: 100%;">
                <option value="" selected>NÃO INFORMADO</option>
                @foreach ($perfis_ouvidoria as $perfil)
                <option value="{{$perfil->id}}" {{old('perfil_ouvidoria_id')==$perfil->id ? 'selected' : '' }}>
                  {{$perfil->nome }}
                </option>
                @endforeach
              </select>
              @error('perfil_ouvidoria_id')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="idade" class="label-required">Idade:</label>
              <input type="text" class="form-control  {{ $errors->has('idade') ? 'is-invalid' : '' }}" id="idade"
                name="idade" placeholder=" " value="">
              @error('idade')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror

            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="quant_filhos" class="label-required">Quant. filhos:</label>
              <input type="text" class="form-control  {{ $errors->has('quant_filhos') ? 'is-invalid' : '' }}"
                id="quant_filhos" name="quant_filhos" placeholder=" " value="">
              @error('quant_filhos')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <div class="form-group">
              <label for="estado_civil" class="label-required">Estado Civil:<span class="text-danger">*</span></label>
              <select class="form-select {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}" id="estado_civil"
                name="estado_civil">
                <option value="0"> NÃO INFORMADO </option>
                <option value="1"> SOLTEIRO(a) </option>
                <option value="2"> CASADO(a) </option>
                <option value="3"> DIVORCIADO(a) OU SEPARADO(a) </option>
                <option value="4"> UNIÃO ESTÁVEL </option>
                <option value="5"> VIÚVO(a) </option>
              </select>
              @error('estado_civil')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="ocupacao" class="label-required">Ocupação:<span class="text-danger">*</span></label>
              <select class="form-select {{ $errors->has('ocupacao') ? 'is-invalid' : '' }}" id="ocupacao"
                name="ocupacao">
                <option value="0"> NÃO INFORMADO </option>
                <option value="1"> TRABALHA NO SETOR PÚBLICO </option>
                <option value="2"> TRABALHA NO SETOR PRIVADO </option>
                <option value="3"> TRABALHA NO SETOR INFORMAL </option>
                <option value="4"> DO LAR </option>
                <option value="5"> DESENPREGADO </option>
                <option value="5"> APOSENTADO </option>
                <option value="5"> OUTROS </option>
              </select>
              @error('ocupacao')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror
            </div>
          </div>
        </div>

      </div>
      <div class="p-0 m-0">
        <h6 class="border-bottom">Dados da Manifestação</h6>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="orgao_ouvidoria_id" class="label-required">Orgão:<span class="text-danger">*</span></label>
              <select class="form-select select2 {{ $errors->has('orgao_ouvidoria_id') ? 'is-invalid' : '' }}"
                name="orgao_ouvidoria_id" required style="width: 100%;">
                <option value="" selected>Selecione</option>
                @foreach ($orgaos_ouvidoria as $orgao)
                <option value="{{$orgao->id}}" {{old('orgao_ouvidoria_id')==$orgao->id ? 'selected' : '' }}>
                  {{$orgao->nome }}
                </option>
                @endforeach
              </select>
              @error('orgao_ouvidoria_id')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="assunto_ouvidoria_id" class="label-required">Assunto:<span class="text-danger">*</span></label>
              <select class="form-select select2 {{ $errors->has('assunto_ouvidoria_id') ? 'is-invalid' : '' }}"
                name="assunto_ouvidoria_id" required ="width: 100%;">
                {{-- <option value="" selected>NÃO INFORMADO</option> --}}
                @foreach ($assuntos_ouvidoria as $assunto)
                <option value="{{$assunto->id}}" {{old('assunto_ouvidoria_id')==$assunto->id ? 'selected' : '' }}>
                  {{$assunto->nome }}
                </option>
                @endforeach
              </select>
              @error('assunto_ouvidoria_id')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <label for="manifestacao">Manifestação:<span class="text-danger">*</span> </label>
            <div class="form-group">
              <textarea class="form-control {{ $errors->has('manifestacao') ? 'is-invalid' : '' }} " name="manifestacao"
                id="manifestacao" cols="30" rows="2"
                placeholder="Deixe aqui sua manifestação."> {{old('manifestacao')}}</textarea>
              @error('manifestacao')
              <small class="invalid-feedback">
                {{ $message }}
              </small>
              @enderror
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <label for="anexo" class="form-label">Anexo </label>
            <div class="input-group mb-3">
              <div class="custom-file">                
                <input type="file" class="form-control" id="anexo" name="anexo[]" multiple>
              </div>
            </div>
            <strong>Tamanho máximo do anexo: 10 MB</strong>
          </div>
        
        </div>
        <div class="row mt-3 ">
          <div class="col-sm-12">
            <div class="submit-button text-center">
              <button class="btn btn-primary" id="submit" type="submit">Enviar</button>
              <div id="msgSubmit" class="h3 text-center hidden"></div>
              <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
  </div>
  </form>
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
