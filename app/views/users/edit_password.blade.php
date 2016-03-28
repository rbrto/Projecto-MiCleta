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

                {{ Form::open(array('route' => 'updatePassword', 'method' => 'POST')) }}

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('current_password','Tu actual contraseña') }}

                            <input type="password" name="current_password" class="form-control" placeholder="">
                            @if( $errors->has('current_password') )
                            @foreach($errors->get('current_password') as $error )
                                <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('password','Nueva contraseña') }}

                            <input type="password" name="password" class="form-control" placeholder="">
                            @if( $errors->has('password') )
                            @foreach($errors->get('password') as $error )
                                <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            {{ Form::label('password_confirmation','Confirma tu nueva contraseña') }}

                            <input type="password" name="password_confirmation" class="form-control" placeholder="">
                            @if( $errors->has('password_confirmation') )
                            @foreach($errors->get('password_confirmation') as $error )
                                <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
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