@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_body')

<p class="login-box-msg">Esqueceu sua senha? Sem problemas. Apenas informe seu endereço de e-mail que enviaremos um link
    que permitirá definir uma nova senha.</p>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
   
<form action="{{ route('password.email') }}" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="email" class="form-control" name="email" :value="old('email')" required autofocus
            placeholder="Email">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">
                Enviar link para redefinir senha por e-mail</button>
        </div>

    </div>
</form>
        {{-- @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            {{ __('adminlte::adminlte.verify_email_sent') }}
        </div>
        @endif --}}

    {{-- @if(session('status')== 'verification-link-sent')
        <div class="alert alert-success" role="alert">
            {{ __('adminlte::adminlte.verify_email_sent') }}
        </div>
    @endif --}}

    {{-- {{ __('adminlte::adminlte.verify_check_your_email') }}
    {{ __('adminlte::adminlte.verify_if_not_recieved') }}, --}}

    {{-- <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
            {{ __('adminlte::adminlte.verify_request_another') }}
        </button>.
    </form> --}}

@stop