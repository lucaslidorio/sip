<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label for="nome_responsavel" class="label-required">Nome Resp. Ouvidoria </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control {{ $errors->has('nome_responsavel') ? 'is-invalid' : '' }}"
                    id="nome_responsavel" name="nome_responsavel" placeholder="Nome do responsável"
                    value="{{ $configuracao->nome_responsavel ?? old('nome_responsavel') }}">
                @error('nome_responsavel')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label for="email">E-mail Ouvidoria:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                </div>
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                    name="email" placeholder="Email" value="{{ $configuracao->email ?? old('email') }}">
                @error('email')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label for="telefone">Telefone :</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control  {{ $errors->has('telefone') ? 'is-invalid' : '' }}"
                    data-inputmask-clearmaskonlostfocus="false" id="telefone" name="telefone"
                    placeholder="Número de tefefone" value="{{ $configuracao->telefone ?? old('telefone') }}">
                @error('telefone')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-3">
        <div class="form-group">
            <label for="celular">Celular:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control  {{ $errors->has('celular') ? 'is-invalid' : '' }}"
                    data-inputmask-clearmaskonlostfocus="false" id="celular" name="celular"
                    placeholder="Número de tefefone" value="{{ $configuracao->celular ?? old('celular') }}">
                @error('celular')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>

    </div>
   
</div>
<div class="row">
 <div class="col-sm-12 col-md-6">
    <div class="form-group">
        <label for="endereco_fisico">Endereço:</label>
        <div class="input-group">
          <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-search-location"></i></span>
          </div>                    
          <input type="text" class="form-control {{ $errors->has('endereco_fisico') ? 'is-invalid' : '' }}"
              id="endereco_fisico" name="endereco_fisico" placeholder="Rua, Número, Bairro, CEP, Cidade"
              value="{{ $configuracao->endereco_fisico ?? old('endereco_fisico') }}">
          @error('endereco_fisico')
              <small class="invalid-feedback">
                  {{ $message }}
              </small>
          @enderror
          </div>
    </div>
</div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label for="dias_atendimento">Dias de Atendimento:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-people-arrows"></i></span>
              </div>                    
              <input type="text" class="form-control {{ $errors->has('dia_atendimento') ? 'is-invalid' : '' }}"
                  id="dias_atendimento" name="dias_atendimento" placeholder="Dias de atendimento"
                  value="{{ $configuracao->dias_atendimento ?? old('dias_atendimento') }}">
              @error('dias_atendimento')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
              </div>
        </div>
    </div>
</div>




<div class="col-sm-12 text-center">
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
    </div>
</div>