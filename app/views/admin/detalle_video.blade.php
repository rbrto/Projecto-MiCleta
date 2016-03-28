@extends('layouts.main')


@section('main_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">

             
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('nombre','Titulo') }}
                            {{ Form::text('nombre', $comment->titulo, array('placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                        </div>
                    </div>
                </div>

          

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('comentario','Descripcion') }}
                            {{ Form::textarea('comentario', $comment->descripcion, array('placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled', 'rows' => '5')) }}
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">

                            <ul class="pager">
                                <li class="previous"><a href="{{route('adminVideos')}}">← Volver Videos </a></li>
                            </ul>
                        </div>
                    </div>
                </div>

         
            </div>
        </section>
    </div>
</div>
@stop


