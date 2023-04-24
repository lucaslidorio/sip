<div class="counters section" data-stellar-background-ratio="0.5">
  {{--  --}}
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="fas fa-handshake"></i>
            </div>
            <div class="fact-count">
              <h3><span class="counter">{{$sessoes_count}}</span></h3>
              <h4>Sessões</h4>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="fas fa-file-invoice"></i>
            </div>
            <div class="fact-count">
              <h3><span class="counter">{{$prositura_count}}</span></h3>
              <h4>Proposituras</h4>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="fa fa-user-tag"></i>
            </div>
            <div class="fact-count">
              <h3><span class="counter">{{$commissions->count()}}</span></h3>
              <h4>Comissões</h4>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3">
          <div class="facts-item">
            <div class="icon">
              <i class="far fa-clipboard"></i>
            </div>
            <div class="fact-count">
              <h3><span class="counter">{{$posts->count()}}</span></h3>
              <h4>Notícias</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>