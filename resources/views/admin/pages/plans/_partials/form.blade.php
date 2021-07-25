      <div class="form-group">
          <label for="nome">Nome <span class="text-danger">*</span></label>
          <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome" name="nome"
              placeholder="Nome da plano" value="{{ $plan->nome ?? old('nome') }}">
          @error('nome')
              <small class="invalid-feedback">
                  {{ $message }}
              </small>
          @enderror
      </div>
      <div class="form-group">
        <label for="preco">Preço <span class="text-danger">*</span></label>
        <input type="number" class="form-control {{ $errors->has('preco') ? 'is-invalid' : '' }}" id="preco" name="preco"
            placeholder="Valor do plano" value="{{ $plan->preco ?? old('preco') }}">
        @error('preco')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
        @enderror
    </div>

      <div class="form-group">
          <label for="descricao">Descrição</label>
          <input type="text" class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" id="descricao"
              name="descricao" placeholder="Descrição do plano"
              value="{{ $plan->descricao ?? old('descricao') }}">
          @error('descricao')
              <small class="invalid-feedback">
                  {{ $message }}
              </small>
          @enderror
      </div>

      <div class="col-sm-12 text-center" >
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
        </div>   
    </div>