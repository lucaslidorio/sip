      
           
           <div class="form-group">
            <label for="nome" class="label-required">Nome: </label>
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
            
            <div class="col-sm-12 text-center" >
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
                    title="Salvar registro">Salvar</button>
                </div>   
            </div>