@extends('public_templates.leg.default')

@section('content')
<div class="row " style="height: 60px; background-color: #f5f5f5">
  <div class="container  ">
      <div class="row mt-4">
          <div class="col-8">
              <p class="fs-1">Dúvidas sobre a Ouvidoria</p>
          </div>
          <div class="col-4 fs-4">{{ Breadcrumbs::render('ouvidoria_duvidas') }} </div>
           
      </div>
  </div>
</div>
<div class="container">
  <section class="row my-5">
    <div class="col-12">  
  
      <div class="accordion" id="accordionOuvidoria">
        <article class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
              aria-expanded="true" aria-controls="collapseOne">
              O que é uma ouvidoria?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
            data-bs-parent="#accordionOuvidoria">
            <div class="accordion-body fs-4">
              A ouvidoria é um canal para você apresentar sugestões, elogios, solicitações, reclamações e denúncias.
              No serviço público, a ouvidoria é uma espécie de “ponte” entre você e a Administração Pública (que são
              os órgãos, entidades e agentes públicos que trabalham nos diversos setores do governo federal, estadual e municipal).
            </div>
          </div>
        </article>
  
        <article class="accordion-item">
          <h3 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
              aria-expanded="false" aria-controls="collapseTwo">
              O que é uma manifestação?
            </button>
          </h3>
          <div id="collapseTwo" class="accordion-collapse collapse fs-4" aria-labelledby="headingTwo"
            data-bs-parent="#accordionOuvidoria">
            <div class="accordion-body">
              A manifestação é uma forma de o cidadão expressar para a ouvidoria seus anseios, angústias, dúvidas, opiniões e sua satisfação com um atendimento ou serviço recebido.
              Assim, pode auxiliar o Poder Público a aprimorar a gestão de políticas e serviços, ou a combater a prática de atos ilícitos.
            </div>
          </div>
        </article>
  
        <article class="accordion-item">
          <h3 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed fs-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
              aria-expanded="false" aria-controls="collapseThree">
              Quais são os tipos de Manifestação?
            </button>
          </h3>
          <div id="collapseThree" class="accordion-collapse collapse fs-4" aria-labelledby="headingThree"
            data-bs-parent="#accordionOuvidoria">
            <div class="accordion-body">
              <p><strong>DENÚNCIA:</strong> Se você quer comunicar a ocorrência de um ato ilícito ou uma irregularidade praticada contra a administração pública. Também pode ser usada para denunciar uma violação aos direitos humanos...</p>
  
              <p><strong>RECLAMAÇÃO:</strong> Se você quer demonstrar a sua insatisfação com um serviço público...</p>
  
              <p><strong>SOLICITAÇÃO:</strong> Se você espera um atendimento ou a prestação de um serviço...</p>
  
              <p><strong>SUGESTÃO:</strong> Se você tiver uma ideia, ou proposta de melhoria dos serviços públicos.</p>
  
              <p><strong>ELOGIO:</strong> Se você foi bem atendido e está satisfeito com o atendimento, e/ou com o serviço que foi prestado.</p>
            </div>
          </div>
        </article>
      </div>
    </div>
  </section>
  
</div>

@endsection