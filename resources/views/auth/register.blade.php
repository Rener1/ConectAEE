@extends('layouts.background_verde')
@section('title','Cadastrar')
@section('content')

<div class="container" style="background-color:#12583C;">

  <br><br><br>

  <div class="panel panel-default col-md-4 col-md-offset-4 sombra" id="login-card">
    <div class="panel-heading text-center" id="login-card">
      <h2>
        <strong>
          Cadastrar
        </strong>
      </h2>
    </div>

    <div class="panel-body" style="margin-top: -30px" id="login-card">
      <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" id="login-card">
          <label for="name" class="col-md-12 control-label">Nome <font color="red">*</font></label>

          <div class="col-md-12" id="login-card">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

            @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}" id="login-card">
          <label for="username" class="col-md-12 control-label">Nome de usuário <font color="red">*</font> </label>

          <div class="col-md-12" id="login-card">
            <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}">

            @if ($errors->has('username'))
            <span class="help-block">
              <strong>{{ $errors->first('username') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" id="login-card">
          <label for="email" class="col-md-12 control-label">E-Mail</label>

          <div class="col-md-12" id="login-card">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

            @if ($errors->has('email'))
            <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}" id="login-card">
          <label for="telefone" class="col-md-12 control-label">Telefone <font color="red">*</font> </label>

          <div class="col-md-12" id="login-card">
            <input  type="digit" name="telefone" id="telefone" minlength="10" placeholder="DDD+Telefone" class="form-control"  maxlength="11" value="{{ old('telefone') }}">

            @if ($errors->has('telefone'))
            <span class="help-block">
              <strong>{{ $errors->first('telefone') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" id="login-card">
          <label for="password" class="col-md-12 control-label">Senha <font color="red">*</font> </label>

          <div class="col-md-12" id="login-card">
            <input id="password" type="password" class="form-control" name="password">

            @if ($errors->has('password'))
            <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
          </div>
        </div>

        <div class="form-group" id="login-card">
          <label for="password-confirm" class="col-md-12 control-label">Confirme a senha <font color="red">*</font> </label>

          <div class="col-md-12" id="login-card">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
          </div>
        </div>

        <div class="form-group" id="login-card">
          <div class="col-md-12 text-center" style="padding-top:20px;" id="login-card">
            <a class="btn btn-secondary" href="{{ route('login') }}" id="menu-a">
              Voltar
            </a>
            <button id="submit"  type="submit" class="btn btn-primary">
              Cadastrar
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>


@endsection
