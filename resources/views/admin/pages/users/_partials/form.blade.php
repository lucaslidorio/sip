      <div class="form-group">
          <label for="name">Nome <span class="text-danger">*</span></label>
          <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name"
              placeholder="Nome Completo" value="{{ $user->name ?? old('name') }}">
          @error('name')
              <small class="invalid-feedback">
                  {{ $message }}
              </small>
          @enderror
      </div>


      <div class="row">
          <div class="col-sm-6">            
            <div class="form-group">
                <label for="email">E-mail<span class="text-danger">*</span></label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                    name="email" placeholder="Email do usuário"
                    value="{{ $user->email ?? old('email') }}">
                 @error('email')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror
            </div>
          </div>
          <div class="col-sm-6">
              <div class="form-group">
                <label for="matricula">Matricula:</label>
                <input type="text" class="form-control {{ $errors->has('matricula') ? 'is-invalid' : '' }}" id="matricula"
                    name="matricula" placeholder="Matrícula do usuário"
                    value="{{ $user->matricula ?? old('matricula') }}">
                @error('matricula')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror           
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
                <label for="password">Senha:<span class="text-danger">*</span></label>
                <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password"
                    name="password" placeholder="Senha">
                @error('password')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror           
              </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
                <label for="password_confirmation">Confirmar Senha:<span class="text-danger">*</span></label>
                <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation"
                    name="password_confirmation" placeholder="Repita a senha">
                @error('password_confirmation')
                    <small class="invalid-feedback">
                        {{ $message }}
                    </small>
                @enderror           
              </div>

          </div>
      </div>

          
      



      <div class="form-group">
          <button type="submit" class="btn btn-success">Salvar</button>
      </div>
