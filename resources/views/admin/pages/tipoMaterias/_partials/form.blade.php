<div class="row">
    <div class="col-sm-12">
        <div class="form-group">                  
            <label for="nome" class="label-required">Nome </label>
              <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-text-width"></i></span>
                  </div> 
              <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                  name="nome" placeholder="Nome do tipo de matéria" value="{{ $tipoMateria->nome ?? old('nome') }}" autofocus>
              @error('nome')
                  <small class="invalid-feedback">
                      {{ $message }}
                  </small>
              @enderror
            </div>
        </div>
    </div>      
</div>
<div class="col-sm-12 text-center" >
  <div class="form-group">
      <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
      title="Salvar registro">Salvar</button>
  </div>   
</div>