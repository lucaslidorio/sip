      <div class="row">
        <div class="col-sm-2">
            <div class="form-group">                  
                <label for="numero" class="">Número </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                      </div> 
                  <input type="number" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" id="numero"
                      name="numero" value="{{ $proposition->numero ?? old('numero') }}">
                  @error('numero')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                </div>
            </div>
        </div> 
        <div class="col-sm-5">
            <div class="form-group">
                <label  for="type_proposition_id" class="label-required" >Tipo:</label>
                <select class="form-control select2 {{ $errors->has('type_proposition_id') ? 'is-invalid' : '' }}" 
                    name="type_proposition_id" id="type_proposition_id" style="width: 100%;" >
                    <option value="" selected >Selecione um tipo</option>   
                    @foreach ($type_propositions as $type)                          
                    <option value="{{$type->id}}"
                        {{(isset($proposition) && $type->id == $proposition->type_proposition->id ? 'selected' : (old('type_proposition_id') == $type->id ? 'selected' : '')) }} 
                          >
                          {{$type->nome}}             
                        </option>
                    @endforeach 
                </select>
                @error('type_proposition_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
              </div>
        </div> 
        
        <div class="col-sm-5">
            <div class="form-group">
                <label  for="councilor_id" >Autor:</label>
                <select class="form-control select2 {{ $errors->has('councilor_id') ? 'is-invalid' : '' }}" 
                    name="councilors[]" id="councilors[]" style="width: 100%;" multiple >
                    {{-- <option value="" selected >Selecione um autor</option>    --}}
                    @foreach ($councilors as $councilor)                          
                    <option value="{{$councilor->id}}"
                        @isset($proposition)
                        @foreach ($proposition->author as $author)                                           
                                {{$councilor->id == $author->id ? 'selected' : ''}}        
                        @endforeach               
                    @endisset
                        >
                        {{$councilor->nome}}             
                        </option>
                    @endforeach 
                </select>
                @error('councilor_id')
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
                <label for="data">Data:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
                  <input type="date" class="form-control" 
                      id="data" name="data"
                      value="{{ $proposition->data ?? old('data') }}">
                
              </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label  for="proceeding_situation_id" class="label-required" >Situação (tramitação):</label>
                <select class="form-control select2 {{ $errors->has('proceeding_situation_id') ? 'is-invalid' : '' }}" 
                    name="proceeding_situation_id" id="proceeding_situation_id" style="width: 100%;" >
                    <option value="" selected >Selecione um tipo</option>   
                    @foreach ($situations as $situation)                          
                    <option value="{{$situation->id}}"
                        {{ (isset($proposition) && $situation->id == $proposition->situation->id ? 'selected' : (old('proceeding_situation_id') == $situation->id ? 'selected' : '')) }} 
                          >
                          {{$situation->nome}}             
                        </option>
                    @endforeach 
                </select>
                @error('proceeding_situation_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
              </div>
        </div> 
    </div> 
      <div class="row">
        <div class="col-sm-12">
            <label for="descricao">Descrição (caput):</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }} " name="descricao" id="descricao" cols="30" rows="2" 
                placeholder="Descrição da Ata">{{$proposition->descricao ?? old('descricao')}}</textarea>
                @error('descricao')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
            </div>
        </div>
    </div>

  
      
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">                  
                <label for="anexo" class="">Arquivo: </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                      </div> 
                  <input type="file" class="form-control {{ $errors->has('anexo') ? 'is-invalid' : '' }}" id="anexo[]"
                      name="anexo[]" placeholder="Nenhum arquivo selecionado" 
                      value="" multiple>
                      
                  @error('anexo')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                 
                </div>   
                <span class="text-danger"> Somente arquivo PDF</span>
            </div>                
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label  for="type_document_id" class="label-required" >Tipo de documento anexo:</label>
                <select class="form-control  {{ $errors->has('type_document_id') ? 'is-invalid' : '' }}" 
                    name="type_document_id" style="width: 100%;" >
                    <option value="" selected >Selecione</option>              
                    @foreach ($type_documents as $type)                          
                    <option value="{{$type->id}}"
                        {{old('type_document_id') ? 'selected':'' }}>
                          {{$type->nome}}         
                        </option>
                    @endforeach 
                </select>
                @error('type_document_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
            </div>
        </div>
    </div>
    
    @isset($proposition)
    <div class="col-sm-12 " id=""> 
        <span>Anexos:</span>                 ​           
        @foreach ($proposition->attachments as $attachment)            
            <div class="row">
            <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" target="_blank" class="mb-2 text-reset" >
                <i class="far fa-file-pdf fa-3x text-danger mr-2"></i>
                <span class="mr-2"> {{$attachment->nome_original}}</span></a> 
           
                <a href="{{route('propositions.deleteAttachment', $attachment->id)}}" data-id="{{$attachment->id}}"
                    class="delete-confirm" data-toggle="tooltip" 
                    title="Excluir Anexo">
                    <span class="fa-stack fa-1x text-danger pt-3">
                        <i class="fas fa-square fa-stack-2x"></i>
                        <i class="fa fa-trash-alt fa-stack-1x fa-inverse" ></i>
                      </span>
                    
                </a> 
            
            </div>
            
        @endforeach           
     </div> 
    @endisset 
            
      
    <div class="col-sm-12 text-center" >
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
        </div>   
    </div>