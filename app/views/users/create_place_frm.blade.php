@extends('layouts.main')

@section('additional_plugins')
@stop

@section('main_content')
<div class="row">
    @if(Session::has('flash_msg'))
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">
                <div class="alert alert-{{ Session::get('flash_type')}}">
                    <button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>{{ Session::get('flash_msg') }}
                </div>
            </div>
        </section>
    </div>
    @endif

    <div class="col-sm-9">
        <section class="panel">
            <div class="panel-body">
                <div id="mapCanvas" style="100%; height: 400px; margin: 0 auto"></div>
            </div>
        </section>
    </div>
    <div class="col-sm-3">
        <section class="panel">
            <div class="panel-body">

                {{ Form::open(array('route' => 'createPlace', 'method' => 'POST', 'name' => 'form_mapa')) }}
                {{ Form::hidden('type', $type) }}

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">

                            {{ Form::text('direccion', $errors->has('direccion') ? Input::old('direccion') : '', array('id' => 'direccion', 'placeholder' => 'Dirección '.$type_translation, 'class' => 'form-control')) }}
                            @if( $errors->has('direccion') )
                            @foreach($errors->get('direccion') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::button('Buscar por dirección', array('class' => 'btn btn-info', 'style' => 'width: 100%', 'onclick' => 'codeAddress()')) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">

                            {{ Form::text('lat', $errors->has('lat') ? Input::old('lat') : '', array('id' => 'lat', 'placeholder' => 'Latitud', 'class' => 'form-control')) }}
                            @if( $errors->has('lat') )
                            @foreach($errors->get('lat') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">

                            {{ Form::text('lon', $errors->has('lon') ? Input::old('lon') : '', array('lon' => 'nombre', 'placeholder' => 'Longitud', 'class' => 'form-control')) }}
                            @if( $errors->has('lon') )
                            @foreach($errors->get('lon') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::button('Buscar por Lat / Lon', array('class' => 'btn btn-info', 'style' => 'width: 100%', 'onclick' => 'codeLatLon()')) }}
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">

                            {{ Form::text('nombre', $errors->has('nombre') ? Input::old('nombre') : '', array('id' => 'nombre', 'placeholder' => 'Nombre '.$type_translation, 'class' => 'form-control')) }}
                            @if( $errors->has('nombre') )
                            @foreach($errors->get('nombre') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::submit('Crear '.$type_translation, array('class' => 'btn btn-primary', 'style' => 'width: 100%')) }}
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
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    // VARIABLES GLOBALES JAVASCRIPT
    var geocoder;
    var marker;
    var latLng;
    var latLng2;
    var map;

    // INICIALIZACION DE MAPA
    function initialize() {
        geocoder = new google.maps.Geocoder();
        latLng = new google.maps.LatLng(-33.49083781258497,-70.61930141217044);
        map = new google.maps.Map(document.getElementById('mapCanvas'), {
            zoom:15,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP});

        // CREACION DEL MARCADOR
        marker = new google.maps.Marker({
            position: latLng,
            title: 'Arrastra el marcador si quieres moverlo',
            map: map,
            draggable: true
        });


        // Escucho el CLICK sobre el mama y si se produce actualizo la posicion del marcador
        google.maps.event.addListener(map, 'click', function(event) {
            updateMarker(event.latLng);
        });

        // Inicializo los datos del marcador
        //updateMarkerPosition(latLng);

        //geocodePosition(latLng);

        // Permito los eventos drag/drop sobre el marcador
        google.maps.event.addListener(marker, 'dragstart', function() {
            updateMarkerAddress('Arrastrando...');
        });

        google.maps.event.addListener(marker, 'drag', function() {
            updateMarkerStatus('Arrastrando...');
            updateMarkerPosition(marker.getPosition());
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            updateMarkerStatus('Determinando posición...');
            geocodePosition(marker.getPosition());
        });
    }

    // ESTA FUNCION OBTIENE LA DIRECCION A PARTIR DE LAS COORDENADAS POS
    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                updateMarkerAddress(responses[0].formatted_address);
            } else {
                updateMarkerAddress('No puedo encontrar esta direccion.');
            }
        });
    }

    // OBTIENE LA DIRECCION A PARTIR DEL LAT y LON DEL FORMULARIO
    function codeLatLon() {
        str= document.form_mapa.lon.value+" , "+document.form_mapa.lat.value;
        latLng2 = new google.maps.LatLng(document.form_mapa.lat.value ,document.form_mapa.lon.value);
        marker.setPosition(latLng2);
        map.setCenter(latLng2);
        geocodePosition (latLng2);
        document.form_mapa.direccion.value = str+" OK";
    }

    // OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
    function codeAddress()
    {
        var address = document.form_mapa.direccion.value;
        geocoder.geocode( { 'address': address}, function(results, status)
        {
            if (status == google.maps.GeocoderStatus.OK)
            {
                updateMarkerPosition(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                map.setCenter(results[0].geometry.location);
            } else {
                alert('ERROR : ' + status);
            }
        });
    }

    // OBTIENE LAS COORDENADAS DESDE lA DIRECCION EN LA CAJA DEL FORMULARIO
    function codeAddress2 (address)
    {

        geocoder.geocode( { 'address': address}, function(results, status)
        {
            if (status == google.maps.GeocoderStatus.OK)
            {
                updateMarkerPosition(results[0].geometry.location);
                marker.setPosition(results[0].geometry.location);
                map.setCenter(results[0].geometry.location);
                document.form_mapa.direccion.value = address;
            } else
            {
                alert('ERROR : ' + status);
            }
        });
    }

    function updateMarkerStatus(str)
    {
        document.form_mapa.direccion.value = str;
    }

    // RECUPERO LOS DATOS LON LAT Y DIRECCION Y LOS PONGO EN EL FORMULARIO
    function updateMarkerPosition (latLng)
    {
        document.form_mapa.lon.value =latLng.lng();
        document.form_mapa.lat.value = latLng.lat();
    }

    function updateMarkerAddress(str)
    {
        document.form_mapa.direccion.value = str;
    }

    // ACTUALIZO LA POSICION DEL MARCADOR
    function updateMarker(location)
    {
        marker.setPosition(location);
        updateMarkerPosition(location);
        geocodePosition(location);
    }

    // Permito la gestiÂ¢n de los eventos DOM
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
@stop
