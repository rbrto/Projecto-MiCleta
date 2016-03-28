@extends('layouts.main')

@section('additional_plugins')
<!--file upload-->
{{ HTML::style('css/bootstrap-fileupload.min.css') }}
@stop

@section('main_content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <div class="panel-body">

                @if(Session::has('flash_msg'))
                <div class="alert alert-{{ Session::get('flash_type')}}">{{ Session::get('flash_msg') }}</div>
                @endif

                {{ Form::open(array('url' => route('updateComment', $comment->id), 'method' => 'put')) }}

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('nombre','Nombre Usuario') }}
                            {{ Form::text('nombre', $comment->nombre, array('placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('email','Email') }}
                            {{ Form::text('email', $comment->email, array('placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('comentario','Comentario') }}
                            {{ Form::textarea('comentario', $comment->comentario, array('placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled', 'rows' => '5')) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ Form::label('publicado','Estado de publicación') }}
                            <select name="publicado" id="publicado" class="form-control m-bot15">
                                <option value="1" {{ $comment->publicado == '1' ? "selected='selected'" : "" }}>Publicado</option>
                                <option value="0" {{ $comment->publicado == '0' ? "selected='selected'" : "" }}>No publicado</option>
                            </select>
                            @if( $errors->has('publicado') )
                            @foreach($errors->get('publicado') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::submit('Guardar Cambios', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">

                            <ul class="pager">
                                <li class="previous"><a href="{{route('adminComments')}}">← Volver a Comentarios</a></li>
                            </ul>
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
    @if(Session::get('admin_comments_edit_hint_seen') == false)
    <script type="text/javascript">
        var hint = "Este formulario permite actualizar el estado de publicación de un comentario.";
        $.gritter.add({
            title: 'Información:',
            text: hint,
            time: 3000
        });
    </script>
    <?php echo Session::put('admin_comments_edit_hint_seen', true) ?>
    @endif
@stop