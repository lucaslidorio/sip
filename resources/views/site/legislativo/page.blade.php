
@extends('site.legislativo.layouts.default')

 @section('content')       
            <div>
              @isset($page)
                <h4 class="font-blue">{{$page->titulo}}</h4>                
                <p>{!!$page->conteudo!!}</p>                
              @endisset             
            </div>
            @isset($page)
              <div>   
                @if(count($page->attachments) > 0)
                <span>Anexos:</span>
                @endif                     
                    
                    @foreach ($page->attachments as $attachment)
                    <div class="row">
                      <a href="{{config('app.aws_url')." {$attachment->anexo}" }}" target="_blank" class="mb-2 text-reset" >
                        <i class="bi bi-paperclip fs-4 text-danger"></i>
                        <span class="mr-2"> {{$attachment->nome_original}}</span></a>                  
                    </div>
                    @endforeach
              </div>
            @endisset

           

            {{-- @foreach ($ultimasNoticias as $noticia)
            <a href="#" class="text-decoration-none" >
              <div class="row p-2 link">
                <div class="container ">
                  <img src="{{config('app.aws_url').$noticia->img_destaque }}" alt="" class="img-fluid  float-start me-3" style="width:130px; height:100px" >
                  <p class="fw-lighter text-dark">{{\Carbon\Carbon::parse($noticia->data_publicacao)->format('d/m/Y')}}</p>
                  <h6 class="text-dark ">{{$noticia->titulo}}</h6>                
                </div>
              </div>
            </a>
            
            @endforeach         --}}
      @endsection