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

                {{ Form::open(array('url' => route('updateService', $place->id), 'method' => 'put')) }}

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('nombre','Nombre del negocio') }} 
                            {{ Form::text('nombre', $place->nombre, array('placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('direccion','Direccion') }}
                            {{ Form::text('direccion', $place->direccion, array('placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled')) }}
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('type','Ingrese los servicios que ofrece este negocio:') }}
                            <label class="checkbox-inline">
                            <input type="checkbox" value="">Option 1
                            </label>
                            <label class="checkbox-inline">
                            <input type="checkbox" value="">Option 2
                            </label>
                            <label class="checkbox-inline">
                            <input type="checkbox" value="">Option 3
                            </label>
                        </div>
                    </div>
                </div> -->

                

                <!-- Se agrega columna de Email y Contraseña 
                Ocultado para nota tres
                -->


                <!-- <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('email','Email') }}
                            {{ Form::text('email', $place->email, array('placeholder' => '', 'class' => 'form-control')) }}
                        </div>
                    </div>
                </div> -->

                <!-- <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group"> -->
                            <!-- vER ALTERNATIVA SOBRE LA VISUALIZACION DE CONTRASEÑA DE PERFIL-->
                            <!-- {{ Form::label('password','Contraseña') }} -->
                            <!-- <input type="password" name="password" class="form-control" placeholder="Contraseña Perfil de Tienda/Taller"> -->
                            <!-- {{ Form::label('password','Password') }}
                            {{ Form::text('password', $place->password, array('placeholder' => '', 'class' => 'form-control')) }} -->
<!--                             {{ Form::text('passwor', $errors->has('password') ? Input::old('password') : $place->password, array('placeholder' => '', 'class' => 'form-control')) }}
 -->                        <!-- </div>
                    </div>
                </div> -->
            <div class="adv-table editable-table ">
            <div class="space15"></div>
            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                <tr>
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('servicios','Ingrese los servicios:') }}
<!--                             {{ Form::text('direccion', $place->direccion, array('placeholder' => '', 'class' => 'form-control', 'disabled' => 'disabled')) }}
 -->                        </div>
                    </div>
                </div>

                    <!-- Id de cada servicio provienen de la base de datos segun servicio -->
                    
                    <div class="checkboxes">
                    <label for="1"><input type="checkbox"  name="servicios[]" id="1"  value="1"/> <span>Cámaras</span></label>
                    <label for="2"><input type="checkbox" name="servicios[]" id="2" value="2" /> <span>Neumáticos</span></label>
                    <label for="3"><input type="checkbox" name="servicios[]" id="3" value="3" /> <span>Frenos</span></label>
                    </div>

                <div class="checkboxes">
                    <label for="4"><input type="checkbox" name="servicios[]" id="4" value="4"/> <span>Cambios de Velocidad</span></label>
                    <label for="5"><input type="checkbox" name="servicios[]" id="5" value="5"/> <span>Cadena</span></label>
                    <label for="6"><input type="checkbox" name="servicios[]" id="6" value="6"/> <span>Centrado de Rueda</span></label>
                    </div>

                    <div class="checkboxes">
                    <label for="1"><input type="checkbox" name="servicios[]" id="7" value="7"/> <span>Masa</span></label>
                    <label for="2"><input type="checkbox" name="servicios[]" id="8" value="8"/> <span>Luces</span></label>
                    <label for="3"><input type="checkbox" name="servicios[]" id="9" value="9"/> <span>Pedales</span></label>
                    </div>

                    <div class="checkboxes">
                    <label for="1"><input type="checkbox" name="servicios[]" id="10" value="10"/> <span>Reparación en general</span></label>
                    <label for="2"><input type="checkbox" name="servicios[]" id="11" value="11"/> <span>Restauracion de bicicletas</span></label>
                    <label for="3"><input type="checkbox" name="servicios[]" id="12" value="12"/> <span>Mantenciones</span></label>
                    <label for="3"><input type="checkbox" name="servicios[]" id="13" value="13"/> <span>Otros Servicios</span></label>
                    </div>
                </tr>    
                </thead>
                <tbody>
                </tbody>         
            </table>
        </div>

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
                            {{ Form::submit('Guardar Servicio(s)', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">

                            <ul class="pager">
                                <li class="previous"><a href="{{route('adminPlaces')}}">← Volver a Lugares</a></li>
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
        var hint = "Este formulario permite ingresar servicios de cada negocio.";
        $.gritter.add({
            title: 'Información:',
            text: hint,
            time: 3000
        });
    </script>
    <?php echo Session::put('admin_comments_edit_hint_seen', true) ?>
    @endif
@stop