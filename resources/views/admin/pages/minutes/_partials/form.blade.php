      <div class="row">
          <div class="col-sm-4">
              <div class="form-group">                  
                  <label for="nome" class="label-required">Nome </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                        name="nome" placeholder="Nome da ata" value="{{ $minute->nome ?? old('nome') }}">
                    @error('nome')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                  </div>
              </div>
          </div> 
          <div class="col-sm-4">
            <div class="form-group">
                <label  for="type_minute_id" class="label-required" >Tipo:</label>
                <select class="form-control select2 {{ $errors->has('type_minute_id') ? 'is-invalid' : '' }}" 
                    name="type_minute_id" id="type_minute_id" style="width: 100%;" >
                    <option value="" selected >Selecione um tipo</option>   
                    @foreach ($types as $type)                          
                    <option value="{{$type->id}}"
                        {{ (isset($minute) && $type->id == $minute->type->id ? 'selected' : (old('type_minute_id') == $type->id ? 'selected' : '')) }} 
                          >
                          {{$type->nome}}             
                        </option>
                    @endforeach 
                </select>
                @error('type_minute_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
              </div>
        </div> 
        <div class="col-sm-4">
            <div class="form-group">
                <label  for="legislature_id" class="label-required" >Legislatura:</label>
                <select class="form-control select2 {{ $errors->has('legislature_id') ? 'is-invalid' : '' }}" 
                    name="legislature_id" id="legislature_id" style="width: 100%;" >
                    <option value="" selected >Selecione uma Legislatura</option>   
                    @foreach ($legislatures as $legislature)                          
                    <option value="{{$legislature->id}}"
                        {{ (isset($minute) && $legislature->id == $minute->legislature->id ? 'selected' : (old('legislature_id') == $legislature->id ? 'selected' : '')) }} 
                          >
                          {{$legislature->descricao}}             
                        </option>
                    @endforeach 
                </select>
                @error('legislature_id')
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
                <label  for="legislature_section_id" class="label-required" >Sessão:</label>
                <select class="form-control select2 {{ $errors->has('legislature_section_id') ? 'is-invalid' : '' }}" 
                    name="legislature_section_id" id="legislature_section_id" style="width: 100%;" >
                    <option value="" selected >Selecione uma Sessão</option>   
                    @foreach ($sections as $section)                          
                    <option value="{{$section->id}}"
                        {{ (isset($minute) && $section->id == $minute->section->id ? 'selected' : (old('legislature_section_id') == $section->id ? 'selected' : '')) }} 
                          >
                          {{$section->descricao}} - {{$section->ano}}           
                        </option>
                    @endforeach 
                </select>
                @error('legislature_section_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
              </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label  for="legislative_period_id" class="label-required" >Período:</label>
                <select class="form-control select2 {{ $errors->has('legislative_period_id') ? 'is-invalid' : '' }}" 
                    name="legislative_period_id" id="legislative_period_id" style="width: 100%;" >
                    <option value="" selected >Selecione um periodo</option>   
                    @foreach ($periods as $period)                          
                    <option value="{{$period->id}}"
                        {{ (isset($minute) && $period->id == $minute->period->id ? 'selected' : (old('legislative_period_id') == $period->id ? 'selected' : '')) }} 
                          >
                          {{$period->descricao}} - {{$period->ano}}           
                        </option>
                    @endforeach 
                </select>
                @error('legislative_period_id')
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
                placeholder="Descrição da Ata">{{$minute->descricao ?? old('descricao')}}</textarea>
                @error('descricao')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
            </div>
        </div>
    </div>

    <div class="card {{ $errors->has('councilors') ? 'card-danger' : '' }}">
        <h5 class="card-header "><strong>Vereadores Presente</h5>
        <div class="card-body ">
             @foreach ($councilors as $councilor)            
             <div class="icheck-primary icheck-inline  {{ $errors->has('councilors') ? 'is-invalid' : '' }}">
                <input type="checkbox" name="councilors[]" value="{{$councilor->id}}" id="{{$councilor->id}}"
                  @if (!@isset($minute)) 
                  checked                   
                  @else                    
                  @endif 
                 @isset($minute)
                        @foreach ($minute->councilors as $minuteCouncilor)                                           
                                {{$councilor->id == $minuteCouncilor->id ? 'checked' : ''}}        
                        @endforeach               
                    @endisset  />
              <label for="{{$councilor->id}}"> {{$councilor->nome}}</label>     
            </div> 
                  
            @endforeach
            @error('councilors')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
        @enderror  
        </div>
      </div> 

      
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">                  
                <label for="anexo" class="">Arquivo: </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
                      </div> 
                  <input type="file" class="form-control {{ $errors->has('anexo') ? 'is-invalid' : '' }}" id="anexo"
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
    </div>
    
    @isset($minute)
    <div class="col-sm-12 " id=""> 
        <span>Anexos:</span>                 ​           
        @foreach ($minute->attachments as $attachment)            
            <div class="row">
            <a href="{{env('AWS_URL')."/{$attachment->anexo}"}}" target="_blank" class="mb-2 text-reset" >
                <i class="far fa-file-pdf fa-3x text-danger mr-2"></i>
                <span class="mr-2"> {{$attachment->nome_original}}</span></a> 
           
                <a href="{{route('minutes.deleteAttachment', $attachment->id)}}" data-id="{{$attachment->id}}"
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