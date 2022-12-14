
 
 <!-- Features Section Start -->
 <section id="features" class="section" data-stellar-background-ratio="0.2">
  <br><br>
    <div class="container" id="institucional">
      <div class="section-header">
        <h2 class="section-title"> <span>Institucional</span></h2>
        <hr class="lines">
        <p class="section-subtitle"></p>
      </div>
      <div class="row align-items-center">
        <div class="col-lg-4 col-sm-6">
           
            <div class="content-left text-md-right">
                <a href="{{route('cartaCidadao.show', $carta_cidadao->id)}}" class="text-decoration-none">
                  <div class="box-item left">
                    <span class="icon">
                      <i class="far fa-envelope-open"></i>
                    </span>
                    <div class="text mt-3">
                      <h4>Carta ao Cidadão</h4>
                      <p>Clique para Visualizar a Carta ao Cidadão</p>
                    </div>
                  </div>  
              </a>
                     
              </div>
            
        </div>
        



        
        <div class="col-lg-4 d-none d-lg-flex">
          <div class="show-box">
            <img src="site/img/features/feature.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-4 col-sm-6">
           
            <a href="{{route('legislacoes.index')}}" class= "text-decoration-none">
              <div class="content-right text-left">
                <div class="box-item right">
                  <span class="icon">
                    <i class="fas fa-balance-scale"></i>
                  </span>
                  <div class="text mt-3">
                    <h4>Regimento Interno</h4>
                    <p>Clique para visualizar o regimento interno</p>
                  </div>
                </div>        
              </div>
            </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Features Section End -->