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

                @if((!Session::get('flash_type')) || (Session::get('flash_type') !== "danger") )
                <div class="row">
                    <div class="col-md-12">
                        @foreach($comments as $c)
                        <div class="well">
                            <blockquote>
                                <small><strong>{{ $c->nombre }}</strong> - <cite title="Source Title">{{ date("d-m-Y",strtotime($c->created_at)) }}</cite></small>
                                <p>{{ $c->comentario }}</p>
                            </blockquote>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </section>
    </div>
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">

                <h2>Publicar un comentario</h2>
                <hr />
                <p>&nbsp;</p>

                {{ Form::open(array('route' => 'createComment', 'method' => 'POST')) }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('nombre','Nombre') }}

                            {{ Form::text('nombre', $errors->has('nombre') ? Input::old('nombre') : '', array('placeholder' => '', 'class' => 'form-control')) }}
                            @if( $errors->has('nombre') )
                            @foreach($errors->get('nombre') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('email','Email (No saldra publicado)') }}

                            {{ Form::text('email', $errors->has('email') ? Input::old('email') : '', array('placeholder' => '', 'class' => 'form-control')) }}
                            @if( $errors->has('email') )
                            @foreach($errors->get('email') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::label('comentario','Comentario') }}

                            {{ Form::textarea('comentario', $errors->has('comentario') ? Input::old('comentario') : '', array('placeholder' => '', 'class' => 'form-control', 'rows' => '5')) }}
                            @if( $errors->has('comentario') )
                            @foreach($errors->get('comentario') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::reset('Borrar', array('class' => 'btn btn-default')) }}
                            {{ Form::submit('Publicar Comentario', array('class' => 'btn btn-primary')) }}
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