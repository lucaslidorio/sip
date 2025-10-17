<div class="row">
    <div class="col-sm-3">
        <div class="form-group">
            <label for="numero" class="label-required">Número:</label>
            <input type="number" class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}"
                   id="numero" name="numero" placeholder="Digite a numero"
                   value="{{ $pergunta->numero ?? old('numero') }}">
            @error('numero')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-sm-9">
        <div class="form-group">
            <label for="pergunta" class="label-required">Texto da Pergunta:</label>
            <input type="text" class="form-control {{ $errors->has('pergunta') ? 'is-invalid' : '' }}"
                   id="pergunta" name="pergunta" placeholder="Digite a pergunta"
                   value="{{ $pergunta->pergunta ?? old('pergunta') }}">
            @error('pergunta')
            <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<!-- Campo oculto do questionário -->
<input type="hidden" name="questionario_id" value="{{ $questionario_id }}">

{{-- <div class="row">
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
</div> --}}

<div class="row">
    <div class="col-sm-12">
        <label class="label-required">Alternativas:</label>
        <div id="alternativas-wrapper">
            @if(isset($alternativas) && count($alternativas) > 0)
                @foreach($alternativas as $alternativa)
                    <div class="input-group mb-2">
                        <input type="text" name="alternativas[]" class="form-control" placeholder="Texto da alternativa" required value="{{ $alternativa->alternativa }}">
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
