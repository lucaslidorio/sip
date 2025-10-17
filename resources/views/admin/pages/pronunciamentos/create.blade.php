@extends('adminlte::page')
@section('title', 'Cadastrar nova Pronunciamento')
@section('plugins.inputmask', false)
@section('plugins.icheck-bootstrap', true)
@section('plugins.Select2', true)
@section('plugins.Summernote', true)

@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Cadastrar nova proposição</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Dashbord</a></li>
          <li class="breadcrumb-item "> <a href="{{route('pronunciamentos.index')}}">Proposições </a></li>
          <li class="breadcrumb-item ">Novo Pronunciamento</li>          
        </ol>
      </div>
    </div>
  </div>

@include('sweetalert::alert')
@stop



@section('content')

<div class="card">
    <div class="card-body">
        <form action="{{route('pronunciamentos.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.pages.pronunciamentos._partials.form')

        </form>
    </div>
</div>
@stop
@section('js')

<script>  
    //inicia o tooltip
    $(function () {
     $('[data-toggle="tooltip"]').tooltip()
     $.fn.select2.defaults.set( "theme", "bootstrap" );   
     $('.select2').select2();
    })
  
    ///inicia o summernote  
    $(document).ready(function() {
      $('#summernote').summernote({
      height: 400,
      lang: 'pt-BR'
      });
    });

    function atualizarPreviewVideo(url) {
    const preview = document.getElementById('preview-video');
    preview.innerHTML = '';
    let embedUrl = '';

    try {
        const parsedUrl = new URL(url);

        // YouTube
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            let videoId = '';
            if (url.includes('youtu.be')) {
                videoId = url.split('youtu.be/')[1];
            } else {
                const params = new URLSearchParams(parsedUrl.search);
                videoId = params.get('v');
            }
            if (videoId) {
                embedUrl = `https://www.youtube.com/embed/${videoId}`;
            }
        }

        // Vimeo
        else if (url.includes('vimeo.com')) {
            const match = url.match(/vimeo\.com\/(\d+)/);
            if (match && match[1]) {
                embedUrl = `https://player.vimeo.com/video/${match[1]}`;
            }
        }

        // Facebook
        else if (url.includes('facebook.com')) {
            embedUrl = `https://www.facebook.com/plugins/video.php?href=${encodeURIComponent(url)}&show_text=false&width=560`;
        }

        if (embedUrl) {
            const iframe = `<iframe width="100%" height="315" src="${embedUrl}" frameborder="0" allowfullscreen></iframe>`;
            preview.innerHTML = iframe;
        }
    } catch (e) {
        console.warn('URL inválida:', url);
    }
}
  </script>
@endsection



