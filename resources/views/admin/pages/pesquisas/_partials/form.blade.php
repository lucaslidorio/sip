<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="texto" class="label-required">Texto da Pergunta:</label>
            <input type="text" class="form-control {{ $errors->has('texto') ? 'is-invalid' : '' }}"
                   id="texto" name="texto" placeholder="Digite a pergunta"
                   value="{{ $pergunta->texto ?? old('texto') }}">
            @error('texto')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<!-- Campo oculto do questionário -->
<input type="hidden" name="questionario_pesquisa_id" value="{{ $questionario_id }}">

<div class="row">
    <div class="col-sm-12">
        <label class="label-required">Alternativas:</label>
        <div id="alternativas-wrapper">
            @if(isset($alternativas) && count($alternativas) > 0)
                @foreach($alternativas as $alternativa)
                    <div class="input-group mb-2">
                        <input type="text" name="alternativas[]" class="form-control" placeholder="Texto da alternativa" required value="{{ $alternativa->texto }}">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-alternativa" title="Remover alternativa"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="input-group mb-2">
                    <input type="text" name="alternativas[]" class="form-control" placeholder="Texto da alternativa" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-alternativa" title="Remover alternativa"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            @endif
        </div>
        <button type="button" class="btn btn-success mt-2 btn-sm" id="add-alternativa"><i class="fas fa-plus"></i> Adicionar Alternativa</button>
    </div>
</div>

<div class="col-sm-12 text-center mt-4">
    <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar pergunta e alternativas">Salvar</button>
</div>
