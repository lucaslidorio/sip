@extends('adminlte::page')
@section('title', 'Anexos do Tenant')

{{-- Habilita plugins do AdminLTE --}}
@section('plugins.Toast', true)
@section('plugins.Sortable', true)
@section('plugins.Sweetalert2', true)
@section('content_header')
{{-- Conteúdo da página --}}
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Entidade</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('tenants.index')}}">Orgão</a></li>
        <li class="breadcrumb-item ">Anexos</li>
      </ol>
    </div>
  </div>
</div>


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
                        <tr id="anexo-{{ $anexo->id }}">
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
                            <td>{{ $anexo->tipo_nome }}</td>
                            <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" 
                                           class="custom-control-input" 
                                           id="customSwitch{{ $anexo->id }}"
                                           {{ $anexo->situacao ? 'checked' : '' }}
                                           onchange="toggleStatus(this, '{{ $tenant->id }}', '{{ $anexo->id }}')">
                                    <label class="custom-control-label" for="customSwitch{{ $anexo->id }}">
                                        {{ $anexo->situacao ? 'Ativo' : 'Inativo' }}
                                    </label>
                                </div>
                            </td>
                            <td>
                                <!-- Replace the delete form with this button -->
                                <button type="button" class="btn btn-flat bg-gradient-danger delete-btn" onclick="confirmDelete('{{ $tenant->id }}', '{{ $anexo->id }}', '{{ $anexo->nome_original }}')"
                                  title="Excluir Anexo">
                                    <i class="fas fa-trash"></i>
                                </button>

                                
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
                            @foreach(App\Models\AnexoTenant::TIPO as $key => $tipo)
                                <option value="{{ $key }}">{{ $tipo }}</option>
                            @endforeach
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

@section('js')
<script>
function toggleStatus(button, tenantId, anexoId) {
    $.ajax({
        url: `/admin/tenants/${tenantId}/anexos/${anexoId}/toggle`,
        type: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            // Atualiza o botão
            if (response.situacao) {
                $(button).removeClass('btn-danger').addClass('btn-success');
                $(button).html('<i class="fas fa-check"></i> Ativo');
            } else {
                $(button).removeClass('btn-success').addClass('btn-danger');
                $(button).html('<i class="fas fa-times"></i> Inativo');
            }

            // Mostra mensagem de sucesso
            Toast.fire({
                icon: 'success',
                title: response.message
            });
        },
        error: function(xhr) {
            Toast.fire({
                icon: 'error',
                title: 'Erro ao alterar status'
            });
        }
    });
}

// Função para confirmar a exclusão
function confirmDelete(tenantId, anexoId, nomeAnexo) {
    Swal.fire({
        title: 'Tem certeza?',
        text: `Deseja realmente excluir o anexo "${nomeAnexo}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, excluir!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/tenants/${tenantId}/anexos/${anexoId}`;
            
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = $('meta[name="csrf-token"]').attr('content');
            
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            
            form.appendChild(csrf);
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

// SweetAlert Toast
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
</script>
@stop