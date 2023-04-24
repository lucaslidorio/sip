      <div class="row">
       
        <div class="col-sm-6">
            <div class="form-group">
                <label  for="commission_id" class="label-required" >Comissão:</label>
                <select class="form-control select2 {{ $errors->has('commission_id') ? 'is-invalid' : '' }}" 
                    name="commission_id" id="commission_id" style="width: 100%;" >
                    <option value="" selected >Selecione uma comissão</option>   
                    @foreach ($commissions as $comission)                          
                    <option value="{{$comission->id}}"
                        {{(isset($seemCommission) && $comission->id == $seemCommission->commission->id ? 'selected' : (old('commission_id') == $comission->id ? 'selected' : '')) }} 
                          >
                          {{$comission->nome}}             
                        </option>
                    @endforeach 
                </select>
                @error('commission_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
              </div>
        </div> 
        <div class="col-sm-6">
            <div class="form-group">
                <label  for="proposition_id" class="label-required" >Propositura:</label>
                <select class="form-control select2 {{ $errors->has('proposition_id') ? 'is-invalid' : '' }}" 
                    name="proposition_id" id="proposition_id" style="width: 100%;" >
                    <option value="" selected >Selecione uma propositura</option>   
                    @foreach ($propositions as $proposition)                          
                    <option value="{{$proposition->id}}"
                        {{(isset($seemCommission) && $proposition->id == $seemCommission->proposition->id ? 'selected' : (old('proposition_id') == $proposition->id ? 'selected' : '')) }} 
                          >
                          {{$proposition->type_proposition->nome}}.  {{$proposition->numero}}/{{\Carbon\Carbon::parse($proposition->data)->format('Y')}}            
                        </option>
                    @endforeach 
                </select>
                @error('proposition_id')
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
                <label for="data" class="label-required">Data</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" id="data" name="data"
                        value="{{ $seemCommission->data ?? old('data') }}">
                        @error('data')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror

                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">                  
                <label for="autoria" class="label-required">Autoria: </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-university"></i></span>
                      </div> 
                  <input type="text" class="form-control {{ $errors->has('autoria') ? 'is-invalid' : '' }}" id="numero"
                      name="autoria" placeholder="Ex. poder legislativo" value="{{ $seemCommission->autoria ?? old('autoria') }}">
                  @error('autoria')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
                </div>
            </div>
        </div> 
    </div> 
      <div class="row">
        <div class="col-sm-12">
            <label for="assunto" class="label-required">Assunto:</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('assunto') ? 'is-invalid' : '' }} " name="assunto" id="assunto" cols="30" rows="2" 
                placeholder="Assunto...">{{$seemCommission->assunto ?? old('assunto')}}</textarea>
                @error('assunto')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <label for="descricao">Descrição:</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }} " name="descricao" id="descricao" cols="30" rows="4" 
                placeholder="descricao...">{{$seemCommission->descricao ?? old('descricao')}}</textarea>
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
                <label for="anexo" class="label-required">Arquivo: </label>
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
    
    @isset($seemCommission)
    <div class="col-sm-12 " id=""> 
        <span>Anexos:</span>                 ​           
        @foreach ($seemCommission->attachments as $attachment)            
            <div class="row">
            <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" target="_blank" class="mb-2 text-reset" >
                <i class="far fa-file-pdf fa-3x text-danger mr-2"></i>
                <span class="mr-2"> {{$attachment->nome_original}}</span></a> 
           
                <a href="{{route('seemCommissions.deleteAttachment', $attachment->id)}}" data-id="{{$attachment->id}}"
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