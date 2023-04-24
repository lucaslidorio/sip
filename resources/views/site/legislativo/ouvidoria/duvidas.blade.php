@extends('site.legislativo.layouts.default')

@section('content')
<div class="row">
  <div class="col-12">
    <h4 class="font-blue text-uppercase">DÚVIDAS SOBRE A OUVIDORIA </h4>


    <div class="accordion" id="accordionExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            O que é uma ouvidoria?
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            A ouvidoria é um canal para você apresentar sugestões, elogios, solicitações, reclamações e denúncias. No serviço público, a ouvidoria é uma espécie de “ponte” entre você e a Administração Pública (que são os órgãos, entidades e agentes públicos que trabalham nos diversos setores do governo federal, estadual e municipal).
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            O que é uma manifestação?
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            A manifestação é uma forma de o cidadão expressar para a ouvidoria seus anseios, angústias, dúvidas, opiniões e sua satisfação com um atendimento ou serviço recebido. Assim, pode auxiliar o Poder Público a aprimorar a gestão de políticas e serviços, ou a combater a prática de atos ilícitos.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
            Quais são os tipos de Manifestação?
          </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <p><strong>DENÚNCIA:</strong> Se você quer comunicar a ocorrência de um ato ilícito ou uma irregularidade praticada contra a administração pública. Também pode ser usada para denunciar uma violação aos direitos humanos. Em alguns casos, a sua manifestação não será classificada como uma denúncia e sim uma solicitação. Por exemplo, se faltam remédios em um hospital público, você poderá fazer uma solicitação para que o órgão tome uma providência. Então, não se trata de uma denúncia.
            </p>
          <p>  <strong>RECLAMAÇÃO:</strong> Se você quer demonstrar a sua insatisfação com um serviço público. Você pode fazer críticas, relatar ineficiência. Também se aplica aos casos de omissão. Por exemplo, você procurou um atendimento ou serviço, e não teve resposta.
          </p>
           <p> <strong>SOLICITAÇÃO:</strong> Se você espera um atendimento ou a prestação de um serviço. Pode ser algo material, como receber um medicamento, ou a ação do órgão em uma situação específica. Por exemplo, se alimentos fora da validade estiverem à venda, você pode solicitar que um órgão público faça uma fiscalização.
          </p>
           <p>  <strong>SUGESTÃO: </strong>Se você tiver uma ideia, ou proposta de melhoria dos serviços públicos.
          </p> 
            <p><strong>ELOGIO:</strong> Se você foi bem atendimento e está satisfeito com o atendimento, e / ou com o serviço que foi prestado.
          </p>
          
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


@endsection