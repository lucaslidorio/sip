     <input type="hidden" name="session_id" value="{{$session->id}}">
    
     <div class="card {{ $errors->has('councilors') ? 'card-danger' : '' }}">
      <h5 class="card-header "><strong>Vereadores Presente</h5>
      <div class="card-body ">
        
        <div class="icheck-primary">
        <input type="checkbox" class="todos" name=""value="" id="todos">
        <label class="check text-primary" for="todos"> MARCAR TODOS </label> 
        </div>
         @foreach ($councilors as $councilor)          
           <div class="icheck-primary   {{ $errors->has('councilors') ? 'is-invalid' : '' }}">
              <input type="checkbox" class="lista" name="councilors[]" value="{{$councilor->id}}" id="{{$councilor->id}}"
               
                      @foreach ($session->councilors_present as $sessionCouncilor)                                           
                              {{$councilor->id == $sessionCouncilor->id ? 'checked' : ''}}        
                      @endforeach               
             
              />
            <label class="check" for="{{$councilor->id}}"> {{$councilor->nome}}</label>     
          </div> 
                
          @endforeach
          @error('councilors')
          <small class="invalid-feedback">
              {{ $message }}
          </small>
      @enderror  
      </div>
    </div> 
       

     
    <div class="col-sm-12 text-center" >
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg align-middle" data-toggle="tooltip" data-placement="top"
            title="Salvar registro">Salvar</button>
        </div>   
    </div>

  
