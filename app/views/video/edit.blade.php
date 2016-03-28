@extends('layouts.main')


@section('main_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">
                
                  @if(Session::has('flash_msg'))
                <div class="alert alert-{{ Session::get('flash_type')}}">{{ Session::get('flash_msg') }}</div>
                @endif


                 {{ Form::open(array('url' => route('video.update', $comment->id), 'method' => 'put')) }}

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('titulo','Titulo') }}
                            {{ Form::text('titulo', $comment->titulo, array('placeholder' => '', 'class' => 'form-control')) }}

                              @if( $errors->has('titulo') )
                            @foreach($errors->get('titulo') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

          

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('descripcion','Descripcion') }}
                            {{ Form::textarea('descripcion', $comment->descripcion, array('placeholder' => '', 'class' => 'form-control', 'rows' => '5')) }}

                              @if( $errors->has('descripcion') )
                            @foreach($errors->get('descripcion') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">

                            {{ Form::submit('Guardar Cambios', array('class' => 'btn btn-primary')) }}
                       
                        </div>
                    </div>
                </div>


                <hr />

<!--
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">

                            <ul class="pager">
                                <li class="previous"><a href="{{ route('video.show',array(Auth::user()->id)) }}">← Volver a Mis Videos</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
-->


         
            </div>
        </section>
    </div>
</div>
@stop


