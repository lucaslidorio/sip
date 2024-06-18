<input type="hidden" name="processo_compra_id" value="{{$processo->id}}">
<div class="row">
  <div class="col-sm-3">
    <div class="form-group">
      <label for="type_document_id" class="label-required">Tipo do Documento:</label>
      <select class="form-control  {{ $errors->has('type_document_id') ? 'is-invalid' : '' }}" name="type_document_id"
        style="width: 100%;">
        <option value="" selected>Selecione</option>
        @foreach ($type_documents as $type)
        <option value="{{$type->id}}" {{old('type_document_id') ? 'selected' :'' }}>
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
  <div class="col-md-9">
    <div class="form-group">
      <label for="descricao" class="">Descricao </label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
        </div>
        <input type="text" class="form-control {{ $errors->has('descricao') ? 'is-invalid' : '' }}" id="descricao"
          name="descricao" placeholder="Descrição do arquivo" value="{{ $attachment->nome ?? old('descricao') }}">
        @error('descricao')
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
    <div class="form-group">
      <label for="anexo" class="label-required">Anexo: </label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-cloud-upload-alt"></i></span>
        </div>
        <input type="file" class="form-control {{ $errors->has('anexo') ? 'is-invalid' : '' }}" id="anexo" name="anexo"
          placeholder="Nenhum arquivo selecionado" value="">

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



<div class="col-sm-12 text-center">
  <div class="form-group">
    <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
      title="Salvar registro">Salvar</button>
  </div>
</div>

<div class="row">

  <table class="table  table-hover table-borderless border-top mt-2 table-sm ">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Anexo</th>
        <th scope="col">Descrição</th>
        <th scope="col">Tipo de documento</th>
        <th scope="col">Downloads</th>
        <th scope="col">Ações</th>

      </tr>
    </thead>
    <tbody>
      @foreach ($processo->anexos as $attachment) <tr>

        <th scope="row">{{$loop->iteration}}</th>
        <td>
          <a href="{{config('app.aws_url')."{$attachment->anexo}" }}"
            target="_blank" class="mb-2 text-reset"
            data-toggle="tooltip" data-placement="top"
            title="Clique para abrir o documento" >
            <i class="far fa-file-pdf fa-2x text-danger mr-2"></i>
            <span class="mr-2"> {{$attachment->nome_original}}</span>
          </a>
        </td>
        <td>
          {{$attachment->descricao}}
        </td>
        <td>
          <span class="mr-2"> {{$attachment->type_document->nome}}</span>
        </td>
        <td>
          <span class="mr-2"> {{$attachment->qtd_download}}</span>
        </td>
        <td>
          <a href="{{route('processoAttachmentDelete.delete', $attachment->id)}}" data-id="{{$attachment->id}}"
            class="mb-2 text-reset" data-toggle="tooltip"  data-placement="top"
            title="Excluir Anexo">
            <span class="fa-stack fa-1x text-danger mr-2">
                <i class="fas fa-square fa-stack-2x"></i>
                <i class="fa fa-trash-alt fa-stack-1x fa-inverse" ></i>
            </span>                    
        </a>
        </td>
       
      </tr>
      @endforeach
    </tbody>
  </table>
</div>