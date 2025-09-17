@extends('adminlte::page')

@section('title', 'Anexos do Tenant')

@section('content_header')
    <h1>Anexos - {{ $tenant->nome }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAnexo">
                <i class="fas fa-plus"></i> Novo Anexo
            </button>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="150">Prévia</th>
                        <th>Nome Original</th>
                        <th>Tipo</th>
                        <th>Situação</th>
                        <th width="100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($anexos as $anexo)
                        <tr>
                            <td class="text-center">
                                <a href="{{ config('app.aws_url').$anexo->anexo }}" target="_blank">
                                    @php
                                        $extension = pathinfo($anexo->nome_original, PATHINFO_EXTENSION);
                                        $isPdf = strtolower($extension) === 'pdf';
                                        $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif']);
                                    @endphp

                                    @if($isImage)
                                        <img src="{{ config('app.aws_url').$anexo->anexo }}" 
                                             alt="{{ $anexo->nome_original }}"
                                             class="img-thumbnail"
                                             style="max-height: 50px;">
                                    @elseif($isPdf)
                                        <i class="far fa-file-pdf text-danger fa-3x"></i>
                                    @else
                                        <i class="far fa-file fa-3x"></i>
                                    @endif
                                </a>
                            </td>
                            <td>{{ $anexo->nome_original }}</td>
                            <td>{{ $anexo->tipo_anexo == 1 ? 'Selo de Transparência' : 'Outro' }}</td>
                            <td>
                                <span class="badge badge-{{ $anexo->situacao ? 'success' : 'danger' }}">
                                    {{ $anexo->situacao ? 'Ativo' : 'Inativo' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('tenants.anexos.toggle', [$tenant->id, $anexo->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        <i class="fas fa-sync"></i>
                                    </button>
                                </form>
                                <form action="{{ route('tenants.anexos.destroy', [$tenant->id, $anexo->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalAnexo" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tenants.anexos.store', $tenant->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Novo Anexo</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Arquivo</label>
                            <input type="file" name="anexo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tipo</label>
                            <select name="tipo_anexo" class="form-control" required>
                                <option value="1">Selo de Transparência</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
<style>
    .img-thumbnail {
        transition: transform 0.2s;
        cursor: pointer;
    }
    .img-thumbnail:hover {
        transform: scale(1.1);
    }
    .far.fa-file-pdf, .far.fa-file {
        transition: transform 0.2s;
        cursor: pointer;
    }
    .far.fa-file-pdf:hover, .far.fa-file:hover {
        transform: scale(1.1);
    }
</style>
@stop