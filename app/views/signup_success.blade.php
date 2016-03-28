@extends('layouts.login')

@section('main_content')

<form class="form-signin" action="{{ url('/register') }}" method="post">
    <div class="form-signin-heading text-center">
        <h1 class="sign-title">Registro Exitoso</h1>
    </div>
    <div class="login-wrap">

        <!-- check for login error flash var -->
        @if (Session::has('flash_success'))
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-success alert-dismissable fade in">
                    <button class="close" data-dismiss="alert">×</button>
                    {{ Session::get('flash_success') }}
                </div>
            </div>
        </div>
        @endif

        <div class="registration">
            <a href="{{ route('login') }}" class="">Iniciar Sesión Ahora</a>
        </div>
        <div class="registration">
            <a href="{{ route('home') }}" class="">Volver al Home</a>
        </div>
    </div>

</form>
@stop