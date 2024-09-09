     <div class="row">
          <div class="col-sm-12">
              <div class="form-group">                  
                  <label for="titulo" class="label-required">Titúlo:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('titulo') ? 'is-invalid' : '' }}" id="titulo"
                        name="titulo" placeholder="Titúlo do documentos" value="{{$documento->titulo ?? old('titulo') }}">
                    @error('titulo')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                  </div>
              </div>
          </div>      
      </div>

      <div class="row">         
          <div class="col-sm-3">
              <div class="form-group">
                  <label for="data_publicacao">Data Publicação:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control" 
                        id="data_publicacao" name="data_publicacao"
                        value="<?php echo date("d/m/Y" ); ?> ">
                  
                </div>
              </div>
          </div>
        
          <div class="col-sm-4">
            <div class="form-group">
                <label class="label-required">Tipo de Matéria:</label>
                <select id="tipo_materia" class="form-control {{ $errors->has('tipo_materia_id') ? 'is-invalid' : '' }}" name="tipo_materia_id" style="width: 100%;">
                    <option value="" selected>Selecione</option>
                    @foreach ($tiposMateria as $tipo_materia)                          
                    <option value="{{$tipo_materia->id}}" 
                          {{(isset($documento) && $tipo_materia->id == $documento->tipo_materia_id ? 'selected' : (old('tipo_materia_id') == $tipo_materia->id ? 'selected' : '')) }}>
                          {{$tipo_materia->nome }}              
                    </option>
                    @endforeach 
                </select>
                @error('tipo_materia_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="label-required">Sub Tipo:</label>
                <select id="sub_tipo_materia" class="form-control {{ $errors->has('sub_tipo_materia_id') ? 'is-invalid' : '' }}" 
                    name="sub_tipo_materia_id" style="width: 100%;" 
                    data-selected="{{ isset($documento) ? $documento->sub_tipo_materia_id : old('sub_tipo_materia_id') }}">
                    <option value="" selected></option>
                    <!-- Os subtipos serão carregados dinamicamente via AJAX -->
                </select>
                @error('sub_tipo_materia_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
                @enderror
            </div>
        </div>

      </div>        
      
           
    
    <div class="row border-danger">
        <div class="col-sm-12  ">
            <label for="conteudo" class="label-required">Conteúdo:</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('conteudo') ? 'is-invalid' : '' }}" name="conteudo" id="summernote" cols="30" rows="10" 
                placeholder="Conteúdo do documento">{{$documento->conteudo ?? old('conteudo')}}</textarea>
                @error('conteudo')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
            </div>
        </div>
    </div>
    
                  
        <div class="col-sm-12 text-center" >
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
                title="Salvar registro">Salvar</button>
            </div>   
        </div>
   
  

      

    
   