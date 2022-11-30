      
      
      <div class="row no-gutters border-bottom pb-2 pt-2 pl-3">
        <h5 class="text-bold">Dados da Manifestação</h5> 
       </div>
       <div class="row no-gutters " > 
          <div class="col-md-4 pb-2 pt-2 pl-3" >  
            <p class="card-text"><strong>Orgão : </strong>{{$ouvidoria->orgao_ouvidoria ? $ouvidoria->orgao_ouvidoria->nome : ''}} </p>
          </div>  
          <div class="col-md-4" style="padding-left: 15px">  
            <p class="card-text"><strong>Assunto : </strong>{{$ouvidoria->assunto_ouvidoria ? $ouvidoria->assunto_ouvidoria->nome : ''}} </p>
          </div>
          <div class="col-md-4" style="padding-left: 15px">    <p class="card-text"><strong>Perfil : </strong>{{$ouvidoria->perfil_ouvidoria ? $ouvidoria->perfil_ouvidoria->nome : ''}} </p>
          </div>   
      </div> 
      <div class="row pr-3 m-3" style="padding-right:20px" >
        <p class="card-text text-justify"><strong>Manifestação:</strong><br>
          {{$ouvidoria->manifestacao}}</p>       
      </div> 

      <div class="row no-gutters">
        <div class="col-sm-12 pb-2 pt-2 pl-3">
            <label for="resposta">Resposta:</label>
            <div class="form-group">
            <textarea class="form-control {{ $errors->has('resposta') ? 'is-invalid' : '' }} " name="resposta" id="resposta" cols="30" rows="2" 
                placeholder="Descrição da Ata">{{$ouvidoria->resposta ?? old('resposta')}}</textarea>
                @error('resposta')
                <small class="invalid-feedback">
                    {{ $message }}
                </small>
            @enderror
            </div>
        </div>
    </div>  
    <div class="col-sm-12 text-center" >
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
        </div>   
    </div>