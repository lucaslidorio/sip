<section id="contato" class="section">
  <br><br>
    <div class="contact-form">
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-md-9">
            <div class="contact-block">
              <div class="section-header">
                <h2 class="section-title">Entrar em  <span>Contato</span></h2>
                <hr class="lines">
              </div>
              <form id="" action="{{route('contato.enviar')}}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Seu nome" required
                        data-error="Por favor digite seu nome">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" placeholder="Seu e-mail" id="email" class="form-control" name="email" required
                        data-error="Por favor digite seu e-mail">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" placeholder="Assunto" id="msg_subject" class="form-control" name="assunto" required
                        data-error="Por favor digite o assunto">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <textarea class="form-control" id="message" name="mensagem" placeholder="Sua mensagem" rows="11"
                        data-error="O campo mensagem esta em branco" required></textarea>
                      <div class="help-block with-errors"></div>
                    </div>
                    {{-- <button class="btn btn-primary" type="submit">
                      Enviar
                    </button> --}}
                    <div class="submit-button text-center">
                      <button class="btn btn-common" id="submit" type="submit">Enviar</button>
                      <div id="msgSubmit" class="h3 text-center hidden"></div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
   
  </section>