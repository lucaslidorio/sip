      <div class="row">
          <div class="col-sm-5">
              <div class="form-group">
                  <label for="type_legislation_id" class="label-required">Tipo:</label>
                  <select class="form-control select2 {{ $errors->has('type_legislation_id') ? 'is-invalid' : '' }}"
                      name="type_legislation_id" id="type_legislation_id" style="width: 100%;">
                      <option value="" selected>Selecione um tipo</option>
                      @foreach ($type_legislations as $type)
                          <option value="{{ $type->id }}"
                              {{ isset($legislation) && $type->id == $legislation->type_legislations->id ? 'selected' : (old('type_legislation_id') == $type->id ? 'selected' : '') }}>
                              {{ $type->nome }}
                          </option>
                      @endforeach
                  </select>
                  @error('type_legislation_id')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
              </div>
          </div>
          <div class="col-sm-2">
              <div class="form-group">
                  <label for="numero" class="">Número </label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                      </div>
                      <input type="number" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}"
                          id="numero" name="numero" value="{{ $legislation->numero ?? old('numero') }}">
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
                  <label for="data " class="label-required">Data Lei:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                      </div>
                      <input type="date" class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" id="data" name="data"
                          value="{{ $legislation->data ?? old('data') }}">
                          @error('data')
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
              <label for="caput">Descrição (caput):</label>
              <div class="form-group">
                  <textarea class="form-control {{ $errors->has('caput') ? 'is-invalid' : '' }} "
                      name="caput" id="caput" cols="30" rows="2"
                      placeholder="Caput, Súmula">{{ $legislation->caput ?? old('caput') }}</textarea>
                  @error('caput')
                      <small class="invalid-feedback">
                          {{ $message }}
                      </small>
                  @enderror
              </div>
          </div>
      </div>

      <div class="row border-danger">
        <div class="col-sm-12  ">
            <label for="descricao">Conteúdo:</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" name="descricao" id="summernote" cols="30" rows="10" 
                placeholder="Texto de Lei">{{$legislation->descricao ?? old('descricao')}}</textarea>
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
                      <input type="file" class="form-control {{ $errors->has('anexo') ? 'is-invalid' : '' }}"
                          id="anexo[]" name="anexo[]" placeholder="Nenhum arquivo selecionado" value="" multiple>

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
                  <label for="type_document_id" class="label-required">Tipo de documento anexo:</label>
                  <select class="form-control  {{ $errors->has('type_document_id') ? 'is-invalid' : '' }}"
                      name="type_document_id" style="width: 100%;">
                      <option value="" selected>Selecione</option>
                      @foreach ($type_documents as $type)
                          <option value="{{ $type->id }}" {{ old('type_document_id') ? 'selected' : '' }}>
                              {{ $type->nome }}
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

      @isset($legislation)
          <div class="col-sm-12 " id="">
              <span>Anexos:</span> ​
              @foreach ($legislation->attachments as $attachment)            
              <div class="row">
              <a href="{{config('app.aws_url')."{$attachment->anexo}" }}" target="_blank" class="mb-2 text-reset" >
                  <i class="far fa-file-pdf fa-3x text-danger mr-2"></i>
                  <span class="mr-2"> {{$attachment->nome_original}}</span></a> 
             
                  <a href="{{route('legislations.deleteAttachment', $attachment->id)}}" data-id="{{$attachment->id}}"
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


      <div class="col-sm-12 text-center">
          <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip"
                  data-placement="top" title="Salvar registro">Salvar</button>
          </div>
      </div>
