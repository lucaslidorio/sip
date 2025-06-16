<form action="{{ isset($pronunciamento) ? route('pronunciamentos.update', $pronunciamento->id) : route('pronunciamentos.store') }}" 
    method="POST" enctype="multipart/form-data">
  @csrf
  @if(isset($pronunciamento))
      @method('PUT')
  @endif

  <div class="row">
      {{-- Vereador (councilor_id) --}}
      <div class="col-sm-6">
          <div class="form-group">
              <label for="councilor_id" class="label-required">Vereador:</label>
              <select name="councilor_id" id="councilor_id" class="form-control select2 {{ $errors->has('councilor_id') ? 'is-invalid' : '' }}">
                  <option value="">Selecione um vereador</option>
                  @foreach ($councilors as $councilor)
                      <option value="{{ $councilor->id }}"
                          {{ (old('councilor_id') ?? $pronunciamento->councilor_id ?? '') == $councilor->id ? 'selected' : '' }}>
                          {{ $councilor->nome }}
                      </option>
                  @endforeach
              </select>
              @error('councilor_id')
                  <small class="invalid-feedback">{{ $message }}</small>
              @enderror
          </div>
      </div>

      {{-- Sessão (session_id) --}}
      <div class="col-sm-6">
          <div class="form-group">
              <label for="session_id" class="label-required">Sessão:</label>
              <select name="session_id" id="session_id" class="form-control select2 {{ $errors->has('session_id') ? 'is-invalid' : '' }}">
                  <option value="">Selecione uma sessão</option>
                  @foreach ($sessoes as $sessao)
                      <option value="{{ $sessao->id }}"
                          {{ (old('session_id') ?? $pronunciamento->session_id ?? '') == $sessao->id ? 'selected' : '' }}>
                          {{ $sessao->nome }} - {{ \Carbon\Carbon::parse($sessao->data)->format('d/m/Y') }}
                      </option>
                  @endforeach
              </select>
              @error('session_id')
                  <small class="invalid-feedback">{{ $message }}</small>
              @enderror
          </div>
      </div>
  </div>

  {{-- Discurso --}}
  <div class="row">
      <div class="col-sm-12">
          <div class="form-group">
              <label for="discurso">Texto do pronunciamento:</label>
              <textarea name="discurso" class="form-control {{ $errors->has('discurso') ? 'is-invalid' : '' }}" id="summernote" cols="30" rows="10" 
                  placeholder="Digite o pronunciamento do vereador">{{ old('discurso', $pronunciamento->discurso ?? '') }}</textarea>
              @error('discurso')
                  <small class="invalid-feedback">{{ $message }}</small>
              @enderror
          </div>
      </div>
  </div>

  {{-- Link do vídeo --}}
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="link_video">Link do vídeo (YouTube, etc):</label>
            <input type="url" name="link_video" id="link_video"
                class="form-control {{ $errors->has('link_video') ? 'is-invalid' : '' }}"
                value="{{ old('link_video', $pronunciamento->link_video ?? '') }}" placeholder="https://..."
                oninput="atualizarPreviewVideo(this.value)">
            @error('link_video')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3">
        <div id="preview-video" class="mt-3">
            @if(!empty($pronunciamento->link_video))
                <iframe width="100%" height="200" src="{{ embedVideo($pronunciamento->link_video) }}" frameborder="0" allowfullscreen></iframe>
            @endif
        </div>
    </div>
</div>


  {{-- Botão de salvar --}}
  <div class="row">
      <div class="col-sm-12 text-center">
          <button type="submit" class="btn btn-primary btn-lg">
              Salvar
          </button>
      </div>
  </div>
</form>
