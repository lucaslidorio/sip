      
           
           <div class="form-group">
            <label for="nome">Nome <span class="text-danger">*</span> </label>
            <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid': '' }}" id="nome" name="nome" placeholder="Nome da categoria" value="{{$categoria->nome ??  old('nome')}}">
            @error('nome')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
            @enderror
        </div>
           
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" 
                class="form-control {{ $errors->has('description') ? 'is-invalid': '' }}" 
                id="description" 
                name="descricao" 
                placeholder="Descrição da categoria"  value="{{$categoria->descricao ?? old('descricao')}}">              
                @error('descricao')
                    <small class="invalid-feedback">
                     {{ $message }}
                    </small>
                @enderror
            </div>

            

            <div class="form-group">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>