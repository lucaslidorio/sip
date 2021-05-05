<!-- Portfolio Section -->
@foreach ($legislatures as $legislature)

@endforeach
@foreach ($directorTables as $mesaDiretora)
<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mix mesa_diretora">
 <div class="portfolio-item">
  <p class="text-justify">{{$mesaDiretora->nome}}</p>
   <div class="shot-item">
 
    <h6 class="">Membros:</h6>
     @foreach ($mesaDiretora->teste as $membro)
       <p class="text-justify">{{$membro->nome}}</p>
     @endforeach
        
     <p class="text-justify">{{$mesaDiretora->nome}}</p>
   </div>
   <h6 class="">Objetivo:</h6>
   <p class="text-justify">{{$mesaDiretora->objetivo}}</p>
 </div>
</div>
@endforeach
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
            {{-- <a class="filter active btn btn-common" data-filter="all">
              All
            </a> --}}
            
            <a class="filter active btn btn-common" data-filter=".mesa_diretora">
              Mesa Diretora
            </a>
            <a class="filter btn btn-common" data-filter=".comissoes">
              Comissões
            </a>
            <a class="filter btn btn-common" data-filter=".print">
              Print
            </a>
          </div>
          <!-- Portfolio Controller/Buttons Ends-->
        </div>
            
        <div id="portfolio" class="row">
             {{-- @foreach ($dataTable as $dados)
              <div class=" text-center col-sm-6 col-md-4 col-lg-4 col-xl-4 mix mesa_diretora">            
                <div class="portfolio-item ">
                  <div class="shot-item ">
                    <a class="overlay-portifolio overlay lightbox " href="{{env('AWS_URL')."/".$dados->members->img }}" >
                      <img src="{{env('AWS_URL')."/".$dados->members->img }}" class="rounded-circle" alt="" style="width: 150px" >
                      <i class="lnr lnr-plus-circle item-icon"></i>
                    </a>
                  </div>
                </div>             
                <h4 class="text-primary">{{$dados->functions->nome}}</h4>                  
                <h6>{{$dados->members->nome}} - {{$dados->members->party->sigla}}</h6>             
                <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
              </div>    
                              
             @endforeach --}}
            
            

             <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mix comissoes">
              <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                {{-- @foreach ($commissions as $commission)
                <a class="nav-link" id="{{$commission->id}}" data-toggle="tab" href="{{$commission->id}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$commission->nome}}</a>
               
                @endforeach                 --}}
                  
                  {{-- <a class="nav-link active" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                  <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a> --}}
                </div>
              </nav>
              
              <div class="tab-content" id="nav-tabContent">
                {{-- @foreach ($commissions  as $commission)
                <div class="tab-pane fade show active" id="{{$commission->id}}" role="tabpanel" aria-labelledby="nav-home-tab">{{$commission->id}}</div>
                @endforeach --}}
                
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
              </div>
              </div>







{{-- 
             @foreach ($dataCommission as $dadosComissao)
             <div class=" text-center col-sm-6 col-md-4 col-lg-4 col-xl-4 mix comissoes">            
               <div class="portfolio-item ">
                 <div class="shot-item ">
                   <a class="overlay-portifolio overlay lightbox " href="{{url("storage/{$dadosComissao->members->img}")}}" >
                     <img src="{{url("storage/{$dadosComissao->members->img}")}}" class="rounded-circle" alt="" style="width: 150px" >
                     <i class="lnr lnr-plus-circle item-icon"></i>
                   </a>
                 </div>
               </div>             
               <h4 class="text-primary">{{$dadosComissao->functions->nome}}</h4>                  
               <h6>{{$dadosComissao->members->nome}} - {{$dadosComissao->members->party->sigla}}</h6>             
               <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
             </div>                     
            @endforeach
             --}}







            <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix">
                <div class="portfolio-item">
                  <div class="shot-item">
                    <a class="overlay lightbox" href="site/img/portfolio/img1.jpg">
                      <img src="site/img/portfolio/img1.jpg" alt="" />
                      <i class="lnr lnr-plus-circle item-icon"></i>
                    </a>
                  </div>
                </div>
              </div>





          <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix development print">
            <div class="portfolio-item">
              <div class="shot-item">
                <a class="overlay lightbox" href="site/img/portfolio/img1.jpg">
                  <img src="site/img/portfolio/img1.jpg" alt="" />
                  <i class="lnr lnr-plus-circle item-icon"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix design">
            <div class="portfolio-item">
              <div class="shot-item">
                <a class="overlay lightbox" href="site/img/portfolio/img2.jpg">
                  <img src="site/img/portfolio/img2.jpg" alt="" />
                  <i class="lnr lnr-plus-circle item-icon"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix development">
            <div class="portfolio-item">
              <div class="shot-item">
                <a class="overlay lightbox" href="site/img/portfolio/img3.jpg">
                  <img src="site/img/portfolio/img3.jpg" alt="" />
                  <i class="lnr lnr-plus-circle item-icon"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix development design">
            <div class="portfolio-item">
              <div class="shot-item">
                <a class="overlay lightbox" href="site/img/portfolio/img4.jpg">
                  <img src="site/img/portfolio/img4.jpg" alt="" />
                  <i class="lnr lnr-plus-circle item-icon"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix development">
            <div class="portfolio-item">
              <div class="shot-item">
                <a class="overlay lightbox" href="site/img/portfolio/img5.jpg">
                  <img src="site/img/portfolio/img5.jpg" alt="" />
                  <i class="lnr lnr-plus-circle item-icon"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 mix design">
            <div class="portfolio-item">
              <div class="shot-item">
                <a class="overlay lightbox" href="site/img/portfolio/img6.jpg">
                  <img src="site/img/portfolio/img6.jpg" alt="" />
                  <i class="lnr lnr-plus-circle item-icon"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    <!-- Container Ends -->
  </section>
  <!-- Portfolio Section Ends -->