
@extends('public_templates.leg.default')
@section('content')



<div class="row " style="height: 60px; background-color: #f5f5f5">
    <div class="container  ">
        <div class="row mt-4">
            <div class="col-8">
                <p class="fs-1">{{$page->titulo}}</p>
            </div>
            <div class="col-4 fs-4">{{ Breadcrumbs::render('page', $page) }}  </div>
             
        </div>
    </div>
  </div>  
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 bg-white p-4 shadow-sm ">          
            @isset($page)                
                <div class="fs-3" style="text-align: justify;">
                    {!! $page->conteudo !!}
                </div>
            @endisset

            @isset($page)
                @if(count($page->attachments) > 0)
                    <div class="mt-4 text-center">
                        <span class="d-block mb-2">Anexos:</span>
                        @foreach ($page->attachments as $attachment)
                            <div class="mb-2">
                                <a href="{{ config('app.aws_url')."{$attachment->anexo}" }}" target="_blank" >
                                    <i class="fas fa-paperclip fs-4 text-danger"></i>
                                    <span class="ml-2">{{$attachment->nome_original}}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endisset
        </div>
    </div>
</div>
@endsection
