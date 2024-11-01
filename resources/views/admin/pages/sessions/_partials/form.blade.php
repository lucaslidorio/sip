      <div class="row">
          <div class="col-sm-6">
              <div class="form-group">                  
                  <label for="nome" class="label-required">Nome </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                        </div> 
                    <input type="text" class="form-control {{ $errors->has('nome') ? 'is-invalid' : '' }}" id="nome"
                        name="nome" placeholder="Nome sessão" value="{{ $session->nome ?? old('nome') }}">
                    @error('nome')
                        <small class="invalid-feedback">
                            {{ $message }}
                        </small>
                    @enderror
                  </div>
              </div>
          </div> 
          
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="data" class="label-required">Data:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                      </div>
                      <input type="date" class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" 
                          id="data" name="data"
                          value="{{$session->data ?? old('data') }}">
                        @error('data')
                          <small class="invalid-feedback">
                              {{ $message }}
                          </small>
                       @enderror                    
                  </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <label for="hora" class="label-required">hora:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-clock"></i></span>
                      </div>
                      <input type="time" class="form-control {{ $errors->has('hora') ? 'is-invalid' : '' }}" 
                          id="hora" name="hora"
                          value="{{$session->hora ?? old('hora') }} "> 
                          @error('hora')
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
                <label  for="type_session_id" class="label-required" >Tipo:</label>
                <select class="form-control{{ $errors->has('type_session_id') ? 'is-invalid' : '' }}" 
                    name="type_session_id" id="type_session_id" style="width: 100%;" >
                    <option value="" selected >Selecione um tipo</option>   
                    @foreach ($types_session as $type)                          
                    <option value="{{$type->id}}"
                        {{ (isset($session) && $type->id == $session->type_session_id ? 'selected' : (old('type_session_id') == $type->id ? 'selected' : '')) }} 
                          >
                          {{$type->nome}}             
                        </option>
                    @endforeach 
                </select>
                @error('type_session_id')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
              </div>
        </div> 
        <div class="col-sm-3">
            <div class="form-group">
                <label  for="legislature_id" class="label-required" >Legislatura:</label>
                <select class="form-control select2 {{ $errors->has('legislature_id') ? 'is-invalid' : '' }}" 
                    name="legislature_id" id="legislature_id" style="width: 100%;" >
                    <option value="" selected >Selecione uma Legislatura</option>   
                    @foreach ($legislatures as $legislature)                          
                    <option value="{{$legislature->id}}"
                        {{ (isset($session) && $legislature->id == $session->legislature->id ? 'selected' : (old('legislature_id') == $legislature->id ? 'selected' : '')) }} 
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
        <div class="col-sm-3">
            <div class="form-group">
                <label  for="legislature_section_id" class="label-required" >Sessão:</label>
                <select class="form-control select2 {{ $errors->has('legislature_section_id') ? 'is-invalid' : '' }}" 
                    name="legislature_section_id" id="legislature_section_id" style="width: 100%;" >
                    <option value="" selected >Selecione uma Sessão</option>   
                    @foreach ($sections as $section)                          
                    <option value="{{$section->id}}"
                        {{ (isset($session) && $section->id == $session->section->id ? 'selected' : (old('legislature_section_id') == $section->id ? 'selected' : '')) }} 
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
        <div class="col-sm-3">
            <div class="form-group">
                <label  for="period_id" class="label-required" >Período:</label>
                <select class="form-control {{ $errors->has('period_id') ? 'is-invalid' : '' }}" 
                    name="period_id" id="period_id" style="width: 100%;" >
                    <option value="" selected >Selecione um periodo</option>   
                    @foreach ($periods as $period)                          
                    <option value="{{$period->id}}"
                        {{ (isset($session) && $period->id == $session->period->id ? 'selected' : (old('period_id') == $period->id ? 'selected' : '')) }} 
                          >
                          {{$period->nome}}           
                        </option>
                    @endforeach 
                </select>
                @error('period_id')
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
                <label for="link_transmissao">Link de Transmissão </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-play"></i></span>
                      </div> 
                  <input type="text" class="form-control {{ $errors->has('link_transmissao') ? 'is-invalid' : '' }}" id="link_transmissao"
                      name="link_transmissao" placeholder="Nome sessão" value="{{ $session->link_transmissao ?? old('link_transmissao') }}">
                  @error('link_transmissao')
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
            <label for="descricao">Descrição:</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }} " name="descricao" id="descricao" cols="30" rows="2" 
                placeholder="Sobre a sessão">{{$session->descricao ?? old('descricao')}}</textarea>
                @error('descricao')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
            </div>
        </div>
    </div>             
    @isset($session)
    <div class="col-sm-12 " id=""> 
        <span>Anexos:</span>                 ​           
        @foreach ($session->attachments as $attachment)            
            <div class="row">
            <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" target="_blank" class="mb-2 text-reset" >
                <i class="far fa-file-pdf fa-3x text-danger mr-2"></i>
                <span class="mr-2"> {{$attachment->nome_original}}</span></a> 
           
                <a href="{{route('sessionAttachmentDelete.delete', $attachment->id)}}" data-id="{{$attachment->id}}"
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