<input type="hidden" name="proposition_id" value="{{$proposition->id}}">

<div class="card {{ $errors->has('councilors') ? 'card-danger' : '' }}">
  <h5 class="card-header ">
    <strong>{{$proposition->type_proposition->nome}} Nº. {{$proposition->numero}} - {{\Carbon\Carbon::parse($proposition->data)->format('d/m/Y')}} </strong>
    </h5>
  <div class="card-body ">    
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label class="label-required">Sessão: </label>
          <span class="badge  badge-info" id="badge_info_sessao">Selecione á sessão que a propositura foi votada</span>
          <select class="form-control {{ $errors->has('session_id') ? 'is-invalid' : '' }}"
            data-url="{{ route('vereadoresSessao.get', null) }}" id="select-sessao" name="session_id"
            style="width: 100%;">
            <option value="" selected>Selecione uma sessão para continuar</option>
            @foreach ($sessions as $session)
            <option value="{{$session->id}}"
              {{ (isset($proposition) && $proposition->votos_propositura()->count() > 0 && 
                $session->id == $proposition->votos_propositura()->first()->pivot->session_id) ? 'selected' : 
                (old('session_id') == $session->id ? 'selected' : '') }}>
            {{$session->nome }} - {{$session->typeSession->nome}} - {{$session->legislature->descricao}}
         
            {{-- {{ (isset($proposition) && $session->id ==
              $proposition->votos_propositura()->first()->pivot->session_id ? 'selected' : (old('session_id') == $session->id ? 'selected'
              : '')) }}
              >
              {{$session->nome }} - {{$session->typeSession->nome}} - {{$session->legislature->descricao}} --}}
            </option>
            @endforeach
          </select>
          @error('session_id')
          <small class="invalid-feedback">
            {{ $message }}
          </small>
          @enderror
        </div>
      </div>
      <div class="col-sm-6">
        <div class="form-group">
            <label  for="proceeding_situation_id" class="label-required" >Situação (tramitação):</label>
            <select class="form-control select2 {{ $errors->has('proceeding_situation_id') ? 'is-invalid' : '' }}" 
                name="proceeding_situation_id" id="proceeding_situation_id" style="width: 100%;" >
                <option value="" selected >Selecione um tipo</option>   
                @foreach ($situations as $situation)                          
                <option value="{{$situation->id}}"
                    {{ (isset($proposition) && $situation->id == $proposition->situation->id ? 'selected' : (old('proceeding_situation_id') == $situation->id ? 'selected' : '')) }} 
                      >
                      {{$situation->nome}}             
                    </option>
                @endforeach 
            </select>
            @error('proceeding_situation_id')
            <small class="invalid-feedback">
                {{ $message }}
            </small>
        @enderror
          </div>
    </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <p><strong>Votos dos Vereadores</strong></p>
      </div>
      </div>
    <input type="hidden" id="tipo_votos" value="{{  $tipo_votos->toJson() }}">
    <table class="table " id="tabela-vereadores">
      
    </table>   
    @error('councilors')
    <small class="invalid-feedback">
      {{ $message }}
    </small>
    @enderror
  </div>
</div>




<div class="col-sm-12 text-center">
  <div class="form-group">
    <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
      title="Salvar registro">Salvar</button>
  </div>
</div>


@section('js')
<script>  
      const selectSessao = document.getElementById('select-sessao');
      
      const urlVereadores = selectSessao.dataset.url;
      const tabelaVereadores = document.getElementById('tabela-vereadores');     
      //Bloco de código verifica se o select de sessão ja possui um valor (caso tenha é porque esta editando),
      //caso tenha, ja preenche a tabela com os vereadores
      const sessionIdInicial = selectSessao.value; // Obter valor inicial do select
      if (sessionIdInicial) {
        fetchVereadores(sessionIdInicial); // Carregar vereadores com valor inicial
      }
      //fim
      selectSessao.addEventListener('change', function(){
        const sessionId = this.value;
        if(!sessionId){
          clearTable();          
          return;
        }
        fetchVereadores (sessionId);
      });

        async function fetchVereadores(sessionId){
        const response = await fetch(`${urlVereadores}/${sessionId}`);
        const vereadores = await response.json();      
       
        showVereadores(vereadores);
      }

      function showVereadores(vereadores){

        tabelaVereadores.innerHTML = ''; // Limpa a tabela
        tabelaVereadores.classList.add('table-hover','table-sm'); 
        const linhaCabecalho = document.createElement('tr');// Criar a linha de cabeçalho da tabela
        linhaCabecalho.innerHTML = `        
            <th scope="col" class="d-none">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Voto</th>        
         
        `;
        linhaCabecalho.classList.add('table-header', 'bg-primary', 'text-white','border','border-primary'); // Exemplo de classes
        tabelaVereadores.appendChild(linhaCabecalho);

        const corpoTabela = document.createElement('tbody'); // Criar e adicionar o elemento <tbody> 
        tabelaVereadores.appendChild(corpoTabela);// Adicionar o corpo da tabela à tabela principal
        
         // Cria e insere linhas na tabela para cada vereador
         for (const vereador of vereadores) {
              const linhaTabela = document.createElement('tr');

              //Coloca borda quando passa o mouse encima da linha
              linhaTabela.addEventListener('mouseover', function() {
              linhaTabela.classList.add('border','border-left','border-primary');
              });

              linhaTabela.addEventListener('mouseout', function() {
              linhaTabela.classList.remove('border','border-left','border-primary');
              })

            // Criar o input hidden
            const inputIdVereador = document.createElement('input');
              inputIdVereador.type = 'hidden';
              inputIdVereador.name = 'id_vereador[]'; // Nome do campo para envio no formulário
              inputIdVereador.value = vereador.id; // Definir o valor do input com o ID do vereador

            
              // Adicionar o input hidden à linha
              linhaTabela.appendChild(inputIdVereador);            
              linhaTabela.innerHTML = `
                  <td class="d-none" ><input type="text" name="councilors[]" id="${vereador.id}" value="${vereador.id}"hidden ></td>
                  <td>${vereador.nome}</td>                  
                  <td class="">
                      <select name="tipo_voto_id[]" class="custom-select" >                          
                          ${getTipoVotoOptions(vereador.tipo_voto_id)}
                      </select>
                  </td>
              `;        

              corpoTabela.appendChild(linhaTabela);            }            
      }
          
        function getTipoVotoOptions(selectedTipoVotoId) {
            const tipoVotos = JSON.parse(document.getElementById('tipo_votos').value);
            let options = '';            
            for (const tipoVoto of tipoVotos) {
            const selected = tipoVoto.id === selectedTipoVotoId ? 'selected' : '';
            options += `<option value="${tipoVoto.id}" ${selected}>${tipoVoto.nome}</option>`;
            }            
            return options;
            }
      
        function clearTable() {
            const tabelaVereadores = document.getElementById('tabela-vereadores');
            tabelaVereadores.innerHTML = '';
         }

         

        //Span informativo encima do select
        const spanMensagem = document.getElementById('badge_info_sessao');         
        selectSessao.addEventListener('change', function() {
        toggleSpanMensagem();
        });
        function toggleSpanMensagem() {
          if (selectSessao.value === '') {
            spanMensagem.style.display = 'inline';
          } else {
            spanMensagem.style.display = 'none';
          }
        }    
  

</script>
@stop