@extends('layouts.login')

@section('main_content')

<form class="form-signin" action="{{ url('/register') }}" method="post">
    <div class="form-signin-heading text-center">
        <h1 class="sign-title">Registro de Usuarios</h1>
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
        <p>Ingresa tus datos personales:</p>

        {{ Form::text('nombre', Input::old('nombre'), array('class' => 'form-control', 'placeholder' => '(*) Nombre', 'autocomplete' => 'off')) }}
        @if( $errors->has('nombre') )
            @foreach($errors->get('nombre') as $error )
            <p class="help-block" style="color: #a94442">{{ $error }}</p>
            @endforeach
        @endif

        {{ Form::text('apellido', Input::old('apellido'), array('class' => 'form-control', 'placeholder' => '(*) Apellido(s)', 'autocomplete' => 'off')) }}
        @if( $errors->has('apellido') )
            @foreach($errors->get('apellido') as $error )
            <p class="help-block" style="color: #a94442">{{ $error }}</p>
            @endforeach
        @endif

        {{ Form::text('alias', Input::old('alias'), array('class' => 'form-control', 'placeholder' => 'Alias', 'autocomplete' => 'off')) }}
        {{ Form::text('direccion', Input::old('direccion'), array('class' => 'form-control', 'placeholder' => 'Dirección', 'autocomplete' => 'off')) }}
        {{ Form::text('edad', Input::old('edad'), array('class' => 'form-control', 'placeholder' => 'Edad', 'autocomplete' => 'off')) }}

        {{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => '(*) Email', 'autocomplete' => 'off')) }}
        @if( $errors->has('email') )
            @foreach($errors->get('email') as $error )
            <p class="help-block" style="color: #a94442">{{ $error }}</p>
            @endforeach
        @endif

        <input type="password" name="password" class="form-control" placeholder="(*) Contraseña">
        @if( $errors->has('password') )
            @foreach($errors->get('password') as $error )
            <p class="help-block" style="color: #a94442">{{ $error }}</p>
            @endforeach
        @endif

        <p class="text-info">
            (*) Campos obligatorios
        </p>
        <button type="submit" class="btn btn-lg btn-login btn-block">
            <i class="fa fa-check"></i>
        </button>

        <div class="registration">
            Ya estoy registrado. <a href="{{ route('login') }}" class="">Iniciar Sesión</a>
        </div>
        <div class="registration">
            <a href="{{ route('home') }}" class="">Volver al Home</a>
        </div>
    </div>

</form>
@stop