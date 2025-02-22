
@extends('public_templates.leg.default')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 bg-white p-4 shadow-sm ">
            {{-- Breadcrumbs --}}
            @isset($page)
                <h4 class="fs-1 text-center">{{$page->titulo}}</h4>
                <div class="">
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
