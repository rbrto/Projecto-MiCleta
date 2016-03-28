@extends('layouts.main')

@section('additional_plugins')
@stop

@section('main_content')
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">

                @if(Session::has('flash_msg'))
                <div class="alert alert-{{ Session::get('flash_type')}}">
                    <button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>{{ Session::get('flash_msg') }}
                </div>
                @endif

                {{ Form::open(array('route' => 'updateProfile', 'method' => 'POST')) }}

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('nombre','(*) Nombre') }}

                            {{ Form::text('nombre', $errors->has('nombre') ? Input::old('nombre') : $user->nombre, array('placeholder' => '', 'class' => 'form-control')) }}
                            @if( $errors->has('nombre') )
                            @foreach($errors->get('nombre') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('apellido','(*) Apellido') }}

                            {{ Form::text('apellido', $errors->has('apellido') ? Input::old('apellido') : $user->apellido, array('placeholder' => '', 'class' => 'form-control')) }}
                            @if( $errors->has('apellido') )
                            @foreach($errors->get('apellido') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('alias','Alias') }}

                            {{ Form::text('alias', $errors->has('alias') ? Input::old('alias') : $user->alias, array('placeholder' => '', 'class' => 'form-control')) }}
                            @if( $errors->has('alias') )
                            @foreach($errors->get('alias') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('email','Email') }}

                            {{ Form::text('email', $errors->has('email') ? Input::old('email') : $user->email, array('placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                            @if( $errors->has('email') )
                            @foreach($errors->get('email') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('direccion','Dirección') }}

                            {{ Form::text('direccion', $errors->has('direccion') ? Input::old('direccion') : $user->direccion, array('placeholder' => '', 'class' => 'form-control')) }}
                            @if( $errors->has('direccion') )
                            @foreach($errors->get('direccion') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('edad','Edad') }}

                            {{ Form::text('edad', $errors->has('edad') ? Input::old('edad') : $user->edad, array('placeholder' => '', 'class' => 'form-control')) }}
                            @if( $errors->has('edad') )
                            @foreach($errors->get('edad') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </section>
    </div>
</div>
@stop

@section('bottom_js')
@stop