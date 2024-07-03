@extends('adminlte::page')

@section('title', 'Crendenciar ao Processo')
@section('plugins.inputmask', false)
@section('plugins.Select2', true)
@section('plugins.icheck-bootstrap', true)

@section('content_header')

<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1>Credenciar ao processo - <strong>{{$processo->numero}} /{{$processo->data_publicacao->year}} -
          {{$processo->modalidade->nome}}</strong></h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
        <li class="breadcrumb-item "> <a href="{{route('processos.index')}}">Processos </a></li>
        <li class="breadcrumb-item ">Credenciar ao processo</li>
      </ol>
    </div>
  </div>
</div>

@include('sweetalert::alert')
@stop



@section('content')

<input type="hidden" name="credenciamento_compra_id" value="{{$credenciamento->id}}">

<div class="card mb-3 mt-3">
  <div class="card-header">
    <div class="row pl-3">
      <h5 class="font-weight-bold">Status do credênciamento: {{$credenciamento->id}}
        <p> <span class="badge badge-info">{{ $ultimaMovimentacao->tipoMovimentacao->nome}}</span></p>
      </h5>
    </div>
  </div>
  <div class="row no-gutters " style="padding:15px">
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong> Número: </strong>{{$processo->numero}}/{{$processo->data_publicacao->year}}</p>
      <p class="card-text"><strong>Modalidade: </strong>
        {{ \Illuminate\Support\Str::upper($processo->modalidade->nome)}}</p>
      <p class="card-text"><strong>Quantidade de lotes: </strong> {{$processo->qtd_lotes}}</p>
      <td>
    </div>
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong>Data de Publicação: </strong> {{$processo->data_publicacao->format('d-m-Y H:i:s')}}
      </p>
      <p class="card-text"><strong>Critério de Julgamento : </strong> {{$processo->criterio_julgamento->nome}}</p>

    </div>
    <div class="col-md-4" style="padding-left: 15px">
      <p class="card-text"><strong>Início da Sessão : </strong> {{$processo->inicio_sessao->format('d-m-Y H:i:s')}}</p>
      <p class="card-text"><strong>Situação do editar-processo-compras: </strong><span
          class="badge badge-info">{{$processo->situacao->nome}}</span></p>

    </div>

    <div class="col-md-12" style="padding-left: 25px">
      <div class="row border-top mt-3 ">
        <p class="card-text text-justify"><strong>Descricao:</strong> <br> {{$processo->descricao}}</p>
      </div>
      <div class="row border-top mt-3 ">
        <p class="card-text text-justify"><strong>Objeto:</strong> <br> {{$processo->objeto}}</p>
      </div>
    </div>

  </div>
  <div class="px-3">
    <div class="mx-3 callout callout-warning">
      <h5 class="text-danger"><i class="icon fas fa-info"></i> Atenção!</h5>
      <h4 class="font-weight-bold">{{$message}}</h4>
    </div>
  </div>


  <div class="px-4">
    <div class="mx-2 card card-default">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-paper-plane "></i> Enviar Documentos</h3>
      </div>
      <div class="card-body">
        <div id="actions" class="row">
          @csrf

          <div class="col-lg-6">
            <div class="btn-group w-100">
              <span class="btn btn-success col fileinput-button">
                <i class="fas fa-plus"></i>
                <span>Adicionar Documentos</span>
              </span>
              <button type="submit" class="btn btn-primary col start">
                <i class="fas fa-upload"></i>
                <span>Enviar Todos</span>
              </button>
              <button type="reset" class="btn btn-warning col cancel">
                <i class="fas fa-times-circle"></i>
                <span>Cancelar</span>
              </button>
            </div>
          </div>
          <div class="col-lg-6 d-flex align-items-center">
            <div class="fileupload-process w-100">
              <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>
                  <span class="total-progress-text">0%</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="table table-striped files" id="previews">
          <div id="template" class="row mt-2">
            <div class="col-auto">
              <span class="preview"><img src="data:," alt data-dz-thumbnail /></span>
            </div>
            <div class="col d-flex align-items-center">
              <p class="mb-0">
                <span class="lead" data-dz-name></span>
                (<span data-dz-size></span>)
              </p>
              <strong class="error text-danger" data-dz-errormessage></strong>
            </div>

            <div class="col-4 d-flex align-items-center">
              <div id="unique-progress" class="progress progress-striped active w-100" role="progressbar"
                aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress>
                  <span class="progress-text">0%</span>
                </div>
              </div>
            </div>

            <div class="col-auto d-flex align-items-center">
              <div class="btn-group">
                <button class="btn btn-primary start">
                  <i class="fas fa-upload"></i>
                  <span>Iniciar</span>
                </button>
                <button data-dz-remove class="btn btn-warning cancel">
                  <i class="fas fa-times-circle"></i>
                  <span>Cancelar</span>
                </button>
                <button data-dz-remove class="btn btn-danger delete">
                  <i class="fas fa-trash"></i>
                  <span>Delete</span>
                </button>
              </div>
            </div>
            <div class="col-12 mt-2 border-bottom ">
              <div class="row">
                <div class="col-md-6 col-sm-6 col-xl-3 mb-md-3 mb-sm-3">
                  <label for="type_document_id" class="label-required">Tipo do Documento:</label>
                  <select class="form-control" name="type_document_id" style="width: 100%;" data-dz-type-document>
                    <option value="" selected>Selecione</option>
                    @foreach ($type_documents as $type)
                    <option value="{{ $type->id }}">{{ $type->nome }}</option>
                    @endforeach
                  </select>
                  <small class="invalid-feedback"></small>
                </div>

              </div>
            </div>
            <input type="hidden" name="credenciamento_compra_id" value="{{$credenciamento->id}}"
              data-dz-credenciamento_compra_id>

          </div>
        </div>
      </div>
    </div>


  </div>
  <div class="card-footer" style="padding-left: 34px">
    <script>
      var uploadedDocuments = @json($documentos);
    </script>

    @can('editar-processo-compras')
    <a class="btn btn-primary" href={{route('processos.edit', ['id'=>$processo->id])}} role="button"
      data-toggle="tooltip"
      data-placement="top" title="Editar Processo">
      <i class="fas fa-edit"></i> Editar</a>
    @endcan
    @can('ver-processos-usuario-externo')
    <a class="btn btn-lg btn-primary" href={{route('processos.edit', ['id'=>$processo->id])}} role="button"
      data-toggle="tooltip"
      data-placement="top" title="Concluir Credenciamento ao processo">
      <i class="fas fa-shopping-cart"></i> Concluir credenciamento</a>
    @endcan
  </div>
</div>

@stop
@section('js')
<script>
  $(function () {
     $('[data-toggle="tooltip"]').tooltip()
    }) 

    Dropzone.autoDiscover = false;

// Get the template HTML and remove it from the document
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

// Get CSRF token
var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

var myDropzone = new Dropzone(document.body, { // Faça de todo o corpo uma zona de lançamento
    url: "{{ route('credenciamento.store.documento') }}", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Certifique-se de que os arquivos não estejam na fila até serem adicionados manualmente
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
    headers: {
        "X-CSRF-TOKEN": csrfToken
    },
    init: function() {
        var myDropzone = this;
        
        // Load existing files
        uploadedDocuments.forEach(function(document) {
            var mockFile = {
                name: document.filename,
                size: document.size,
                type: 'image/jpeg',
                documentId: document.id
            };

            myDropzone.displayExistingFile(mockFile, `/anexos_credenciamentos/${document.filename}`);
            
            // Adicione a funcionalidade do botão iniciar e excluir
            mockFile.previewElement.querySelector(".start").setAttribute("disabled", "disabled");

            mockFile.previewElement.querySelector(".delete").addEventListener("click", function() {
                fetch(`{{ url('/admin/processos/credenciamento') }}/${document.id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao deletar o documento.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        myDropzone.removeFile(mockFile);
                        console.log('Documento deletado com sucesso!');
                    } else {
                        throw new Error('Erro ao deletar o documento: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erro ao deletar o documento:', error);
                });
            });
        });

        this.on("addedfile", function(file) {
            var startButton = file.previewElement.querySelector(".start");

            startButton.onclick = function() {
                var typeDocumentId = file.previewElement.querySelector("[data-dz-type-document]").value;
                var selectElement = file.previewElement.querySelector("[data-dz-type-document]");
                var errorMessageElement = file.previewElement.querySelector(".invalid-feedback");

                if (!typeDocumentId) {
                    selectElement.classList.add("is-invalid");
                    errorMessageElement.textContent = "Por favor, selecione o tipo de documento.";
                } else {
                    selectElement.classList.remove("is-invalid");
                    errorMessageElement.textContent = "";
                    myDropzone.enqueueFile(file);
                }
            };
        });

        this.on("sending", function(file, xhr, formData) {
            var typeDocumentId = file.previewElement.querySelector("[data-dz-type-document]").value;
            var credenciamentoCompraId = file.previewElement.querySelector("[data-dz-credenciamento_compra_id]").value;

            formData.append("type_document_id", typeDocumentId);
            formData.append("credenciamento_compra_id", credenciamentoCompraId);
        });

        // Update the total progress bar
        this.on("totaluploadprogress", function(progress) {
            var progressBar = document.querySelector("#total-progress .progress-bar");
            var progressText = progressBar.querySelector(".total-progress-text");
            progressBar.style.width = progress + "%";
            progressText.textContent = Math.round(progress) + "%";
        });

        // Update the individual file progress bar
        this.on("uploadprogress", function(file, progress) {
            var progressBar = file.previewElement.querySelector(".progress-bar");
            var progressText = progressBar.querySelector(".progress-text");
            progressBar.style.width = progress + "%";
            progressText.textContent = Math.round(progress) + "%";
        });

        this.on("queuecomplete", function() {
            document.querySelector("#total-progress").style.opacity = "0";
        });

        document.querySelector("#actions .start").onclick = function() {
            var files = myDropzone.getFilesWithStatus(Dropzone.ADDED);
            files.forEach(function(file) {
                var typeDocumentId = file.previewElement.querySelector("[data-dz-type-document]").value;
                var selectElement = file.previewElement.querySelector("[data-dz-type-document]");
                var errorMessageElement = file.previewElement.querySelector(".invalid-feedback");

                if (!typeDocumentId) {
                    selectElement.classList.add("is-invalid");
                    errorMessageElement.textContent = "Por favor, selecione o tipo de documento.";
                } else {
                    selectElement.classList.remove("is-invalid");
                    errorMessageElement.textContent = "";
                    myDropzone.enqueueFile(file);
                    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
                }
            });
        };

        document.querySelector("#actions .cancel").onclick = function() {
            myDropzone.removeAllFiles(true);
        };

        this.on('error', function(file, response) {
            console.log('Erro ao carregar o arquivo');
            console.log(response);
            alert('Erro: ' + response.error);
        });
    }
});



















</script>
@endsection