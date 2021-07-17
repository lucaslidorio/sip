<!-- Portfolio Section -->


<section id="sobre" class="section">
    <!-- Container Starts -->
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">A <span>Câmara</span></h2>
        <hr class="lines">
        <p class="section-subtitle">{{$legislature->descricao}}</p>
      </div>      
      <div class="row">
        <div class="col-md-12">
          <!-- Portfolio Controller/Buttons -->
          <div class="controls text-center">
            <a class="filter btn btn-common" data-filter=".mesa">
              Mesa Diretora
            </a>
            <a class="filter btn btn-common" data-filter=".comissoes">
              Comissões
            </a>
            
          </div>
          <!-- Portfolio Controller/Buttons Ends-->
        </div>            
        <div id="portfolio" class="row">  
          {{-- Mesa diretora    --}}
             @foreach ($directorTables as $mesaDiretora)
             <div class="row mix mesa" > 
               <h2  class="text-primary"> <u> Objetivo</u></h2> 
              <p class="text-justify" style="font-size: 16px">{{$mesaDiretora->objetivo}}</p>
              <h2 class="text-primary text-center font-weight-bolder border-bottom border-primary "><span>Membros</span></h2>
             </div>                       
                @foreach ($mesaDiretora->members as $membro)                
                <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix mesa"> 
                  
                  <div class="portfolio-item ">
                    <div class="shot-item text-center">
                      <a class="overlay-portifolio overlay lightbox " href="{{config('app.aws_url').$membro->img }}" >
                        <img src="{{config('app.aws_url').$membro->img }}" class="rounded-circle" alt="" style="width: 150px" >
                        <i class="lnr lnr-plus-circle item-icon"></i>
                      </a>
                    </div>
                  </div>
                    @foreach ($membro->functionTable as $funcao)
                      <h6 class="text-primary text-center ">{{$funcao->nome}}</h6>   
                    @endforeach       
                      
                <h6 class="text-center">{{$membro->nome}} - {{$membro->party->sigla}}</h6>             
                <p class="text-center"><a class="btn btn-secondary" href="{{route('vereadores.show', $membro->nome)}}" role="button">Ver Detalhes &raquo;</a></p>
              </div> 
                @endforeach
               
              @endforeach

             {{-- Fim mesa diretora --}}
            
            {{-- Comissões --}}   
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mix comissoes" >                
                <ul class="nav nav-tabs " id="myTab" role="tablist">
                  @foreach($commissions as $comissao)
                        <li class="nav-item" role="presentation">
                          <a class="nav-link {{$loop->index ==0 ? 'active': ''}} " id="home-tab" data-toggle="tab" href="#{{$comissao->id}}" role="tab" aria-controls="home" aria-selected="true">
                            {{$comissao->nome}}
                          </a>
                        </li>
                  @endforeach
                  
                  
                </ul>

            <div class="tab-content" id="myTabContent">
            
                  @for ($i = 0; $i < count($membrosComissao); $i++)    
                    @foreach ($membrosComissao[$i] as $membros)
                    @endforeach         
                            
                    <div class="tab-pane fade {{$i ==0 ? 'show active': ''}} " id="{{$membros->commission_id}}" role="tabpanel" aria-labelledby=" {{$membros->commission_id}}">  
                    
                      <h5 class="text-primary pt-3"><u> Objetivo</u></h5>                    
                      <p class="text-justify">{{$membros->commission->objetivo}}</p>
                      <h2 class="text-primary text-center font-weight-bolder border-bottom border-primary "><span>Membros</span></h2>

                      <div class="row text-center"> 
                                             
                        @foreach ($membrosComissao[$i] as $membros)
                          <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4">
                            <div class="portfolio-item display-inline">
                              <div class="shot-item text-center">
                                <a class="overlay-portifolio overlay lightbox " href="{{config('app.aws_url').$membros->members->img }}" >
                                  <img src="{{config('app.aws_url').$membros->members->img  }}" class="rounded-circle" alt="" style="width: 150px" >
                                  <i class="lnr lnr-plus-circle item-icon"></i>
                                </a>                          
                            </div>                                 
                          </div>                          
                            <h6 class="text-primary text-center ">{{$membros->functions->nome}}</h6>  
                            <h6 class="text-center">{{$membros->members->nome}} - {{$membros->members->party->sigla}}</h6>             
                            <p class="text-center"><a class="btn btn-secondary" href="{{route('vereadores.show', $membros->members->nome)}}" role="button">Ver Detalhes &raquo;</a></p>
                          </div>
                        @endforeach                      
                      </div>                   
                    </div>          
                @endfor     

            </div>
          </div>   
        </div>
      </div>
      {{-- Fim Comissões --}}   
    </div>
    <!-- Container Ends -->
  </section>
  <!-- Portfolio Section Ends -->