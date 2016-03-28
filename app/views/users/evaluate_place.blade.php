@extends('layouts.main')

@section('additional_plugins')
@stop

@section('main_content')
<div class="row">

    <div class="col-sm-6">
        <section class="panel">
            <div class="panel-body" style="min-height: 144px">
                <div class="media usr-info">
                    <a href="#" class="pull-left">
                        <img src="{{ asset('images/'.$place->type.'.jpg') }}" class="thumb" />
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $place->nombre }}</h4>
                        <span style="margin-bottom: 27px">{{ $place->direccion }}</span>
                    </div>
                </div>
            </div>
            <div class="panel-footer custom-trq-footer">
                <div class="row">
                    <div class="col-sm-6">
                        <span style="font-weight: bold; color: rgb(15, 93, 94) ">Latitud :</span><br />{{ $place->lat }}
                    </div>
                    <div class="col-sm-6">
                        <span style="font-weight: bold; color: rgb(15, 93, 94)">Longitud :</span><br />{{ $place->lon }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-sm-6" style="min-height: 45px">
        <section class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <section class="panel" style="margin-bottom: 0">
                            <h4>Puntuación</h4>
                            <p><i class="fa fa-star fa-4x" style="color: gold">{{ $score_average }}</i></p>
                        </section>
                    </div>

                    <div class="col-sm-6">
                        <section class="panel" style="margin-bottom: 0">
                            <h4>Votos Totales</h4>
                            <p style="font-size: 4em; margin-top: 1px; line-height: 56px; margin-bottom: 1px; font-family: FontAwesome;">{{ $score_counter }}</p>
                        </section>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <section class="panel" style="margin-bottom: 0">
                            <h4>@if(!$has_evaluated) Evalúa est{{ $place->type == "shop" ? "a tienda" : "e estacionamiento" }}: @else Usted ya evaluó este estacionamiento: @endif</h4>
                            <div class="panel-body" id="rating_panel" style="min-height: 71px">
                                @if(!$has_evaluated)
                                    <span class="rating">
                                            <span id="7" class="star"></span>
                                            <span id="6" class="star"></span>
                                            <span id="5" class="star"></span>
                                            <span id="4" class="star"></span>
                                            <span id="3" class="star"></span>
                                            <span id="2" class="star"></span>
                                            <span id="1" class="star"></span>
                                    </span>
                                @else
                                    <p style="text-align: center;"><input id="deleteEvaluation" type="button" class="btn btn-danger" value="Quitar evaluación" /></p>
                                @endif
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <header class="panel-heading">
                    <h4>Comentarios</h4>
                </header>

                @if(Session::has('flash_msg'))
                <div class="alert alert-{{ Session::get('flash_type')}}">
                    <button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>{{ Session::get('flash_msg') }}
                </div>
                @endif

                @if((!Session::get('flash_type')) || (Session::get('flash_type') !== "danger") )
                <div class="row">
                    <div class="col-md-12">
                        @foreach($place_comments as $p)
                        <div class="well">
                            <blockquote>
                                <small><strong>{{ $p->user->nombre." ".$p->user->apellido }}</strong> - <cite title="Source Title">{{ date("d-m-Y",strtotime($p->created_at)) }}</cite></small>
                                <p>{{ $p->comentario }}</p>
                            </blockquote>
                        </div>
                        @endforeach

                        @if(!$place_comments)
                            <p>No hay comentarios que mostrar.</p>
                        @endif
                    </div>
                </div>
                @endif

            </div>
        </section>

        <section class="panel">
            <div class="panel-body">

                <h2>Publicar un comentario</h2>
                <hr />

                {{ Form::open(array('route' => 'createPlaceComment', 'method' => 'POST')) }}
                {{ Form::hidden('place_id', $place->id) }}

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
<script>
    $(document).ready(function(){
        /*$(".rating > i").hover(function() {
            $(this).css("color", "gold");
            $(this).prevAll().css("color", "gold");
        }, function() {
            $(this).css("color", "");
            $(this).prevAll().css("color", "");
        });*/
        $(".rating > span").click(function() {
            var params = {
                "place_id": "{{ $place->id }}",
                "score": $(this).attr("id")
            };

            $.ajax({
                data: params,
                url: "{{ route('scorePlace') }}",
                type: "POST",
                beforeSend: function() {
                    $("#rating_panel").html("<p>Evaluando, espere por favor...</p>");
                },
                success: function(response) {
                    switch (response.return){
                        case "validation_error":
                            alert("Error de validacion");
                            break;
                        case "storage_error":
                            alert("Error de almacenamiento");
                            break;
                        case "success":
                            $("#rating_panel").html("<p>Gracias por la evaluación, refresque la página en caso de querer eliminar su evaluación.</p>");
                    }
                }
            });
        });

        $("#deleteEvaluation").click(function() {
            var params = {
                "place_id": "{{ $place->id }}"
            };

            $.ajax({
                data: params,
                url: "{{ route('deletePlaceScore') }}",
                type: "POST",
                beforeSend: function() {
                    $("#rating_panel").html("<p>Eliminando, espere por favor...</p>");
                },
                success: function(response) {
                    switch (response.return){
                        case "validation_error":
                            alert("Error de validacion");
                            break;
                        case "storage_error":
                            alert("Error de almacenamiento");
                            break;
                        case "exception_error":
                            alert("Error de almacenamiento");
                            break;
                        case "success":
                            $("#rating_panel").html("<p>Has quitado tu evaluación con éxito.</p>");
                    }
                }
            });
        });
    });
</script>
@stop