@extends('layouts.login')

@section('main_content')

<form class="form-signin" action="{{ url('/login') }}" method="post">
    <div class="form-signin-heading text-center">
        <h1 class="sign-title">Login Usuarios</h1>
        <!-- <img src="images/login-logo.png" alt=""/>-->
    </div>
    <div class="login-wrap">

        <!-- check for login error flash var -->
        @if (Session::has('flash_error'))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissable fade in">
                    <button class="close" data-dismiss="alert">×</button>
                    {{ Session::get('flash_error') }}
                </div>
            </div>
        </div>
        @endif

        <p>Ingresa tus credenciales de acceso:</p>

        {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Email', 'autocomplete' => 'off')) }}
        <input type="password" name="password" class="form-control" placeholder="Password">

        <button class="btn btn-lg btn-login btn-block" type="submit">
            <i class="fa fa-check"></i>
        </button>

        <div class="registration">
            No tengo cuenta. <a href="{{ route('signup') }}" class="">Registrarme</a>
        </div>
        <div class="registration">
            <a href="{{ route('home') }}" class="">Volver al Home</a>
        </div>

    </div>

</form>
@stop