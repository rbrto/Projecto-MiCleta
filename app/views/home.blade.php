@extends('layouts.main')

@section('additional_plugins')
@stop

@section('main_content')

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="panel-body">
                    <div id="googft-mapCanvas" style="width:900px; height: 400px; margin: 0 auto"></div>
                </div>
            </section>
        </div>
        <div class="col-sm-12">

            <form class="form-horizontal adminex-form" method="get">

                <div class="row">
                    <div class="col-sm-7">
                        <p>
                            <a href="{{ route('shops') }}"><img src="{{ asset('images/red_marker.png') }}" /> Tienda de Bicicletas</a>
                            <a href="{{ route('workshops') }}"><img src="{{ asset('images/green_marker.png') }}" /> Taller de Reparación</a>
                            <a href="{{ route('parkings') }}"><img src="{{ asset('images/yellow_marker.png') }}" /> Estacionamiento</a></p>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <select id="type" class="form-control m-bot15">
                                    <option
                                    <option value="all" @if($show == 'all') selected="selected" @endif>Mostrar Todo</option>
                                    <option value="shops" @if($show == 'shops') selected="selected" @endif>Tiendas</option>
                                    <option value="workshops" @if($show == 'workshops') selected="selected" @endif>Talleres</option>
                                    <option value="parkings" @if($show == 'parkings') selected="selected" @endif>Estacionamientos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="row blog">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="blog-img-sm">
                                <img src="images/photo1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h1 class=""><a href="#">BIENVENIDOS A MI CLETA</a></h1>
                            <p class=" auth-row">
                            
                            </p>
                            <p><h4>Bienvenidos a Mi Cleta. Sé parte de nuestra plataforma creado para tu medio de transporte, tú bicicleta, y no pares de pedalear. </h4> </p>
                            <a href="https://www.facebook.com/micletaproyecto" target="_blank"><img src="images/facebook01.png" width=40 height=40> </a>&nbsp; &nbsp;
                            <a href="https://play.google.com/store" target="_blank"><img src="images/google_play01.png" width=40 height=40> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<div class="row blog">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-body">

                    <h1 class=""><a href="#">&Uacute;LTIMO EVENTO</a></h1>

                    <p>Ruta: Bicicletas de ruta, delgadas para usarse sobre pavimento. El tour de France es el evento más popular de bici de ruta, en México seria la vuelta a México, pero hay muchos eventos más que aquí vamos a informar para invitarlos a participar. Montaña MTB: Bicicletas más robustas hechas para pedalear sobre todos los terrenos, existe dentro de estas varios tipos y modalidades de competencia, aquí pondremos todo lo posible. Urbano: ciclisimo en la ciudad y también, "Fixed bikes". La nueva modalidad de bicis arregladas y tuneadas para andar en la ciudad, hay algunos eventos.</p>
                    <p>Importante!! Este domingo no tendremos seguridad en la ruta. Aun continuamos trabajando fuertemente para renovar el permiso. El Dept de Recreacion y Deportes al igual que DTOP nos han asegurado que para el proximo domingo tendremos renovado el permiso para cierre. Todo esto ordenado por el gobernador. Busquen rutas alternas y si deciden rodar en la 165 haganlo con extrema precaucion. Gracias!!</p>

                </div>
            </div>
        </div>
    </div>-->
@stop

@section('bottom_js')
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#type').on('change', function(){
                var type = $(this).val();

                switch(type){
                    case 'all':
                        window.location = "{{ route('home') }}";
                        break;
                    case 'shops':
                        window.location = "{{ route('shops') }}";
                        break;
                    case 'workshops': //Se Agrego en el combobox el switch  de taller
                        window.location = "{{ route('workshops') }}";
                        break;
                    case 'parkings':
                        window.location = "{{ route('parkings') }}";
                        break;   
                }
            });

        });
        function initialize()
        {
            google.maps.visualRefresh = true;
            var isMobile = (navigator.userAgent.toLowerCase().indexOf('android') > -1) ||
                (navigator.userAgent.match(/(iPod|iPhone|iPad|BlackBerry|Windows Phone|iemobile)/));

            if (isMobile)
            {
                var viewport = document.querySelector("meta[name=viewport]");
                viewport.setAttribute('content', 'initial-scale=1.0, user-scalable=no');

            }
            var mapDiv = document.getElementById('googft-mapCanvas');
            mapDiv.style.width = isMobile ? '100%' : '100%';
            mapDiv.style.height = isMobile ? '100%' : '400px';
            var map = new google.maps.Map(mapDiv, {
                center: new google.maps.LatLng(-33.4966713877166, -70.60458183288574),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            if (isMobile)
            {
                var legend = document.getElementById('googft-legend');
                var legendOpenButton = document.getElementById('googft-legend-open');
                var legendCloseButton = document.getElementById('googft-legend-close');

                legend.style.display = 'none';
                legendOpenButton.style.display = 'block';
                legendCloseButton.style.display = 'block';
                legendOpenButton.onclick = function()
                {

                    legend.style.display = 'block';
                    legendOpenButton.style.display = 'none';

                }
                legendCloseButton.onclick = function()
                {
                    legend.style.display = 'none';
                    legendOpenButton.style.display = 'block';
                }
            }

            var myLatlng, myOptions, contentString, marker;
            var infowindow = new Array();

            var cont = 0;

            @foreach($places as $p)

                myLatlng = new google.maps.LatLng( {{ $p->lat }},{{ $p->lon }} );
                myOptions =
                {
                    zoom: 4,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }

                var inner_route = "{{ route('evaluatePlace', $p->id) }}";

                contentString = //PENDIENTE ------ Aca hay q agregar el taller en el if else
                    '<div id="content">' +
                    '<div id="siteNotice">' +
                    '</div>' +
                    '<h3 id="firstHeading">@if( $p->type == 'shop' ) Tienda de Bicicletas: @elseif( $p->type == 'workshop' ) Taller de Reparación:  @else Estacionamiento: @endif</h3>' +
                    '<div id="bodyContent">' +
                    "<hr /><p><b>{{ $p->nombre }}</b></p><p><span style='color: #9E9E9E'>{{ $p->direccion }}</span></p>" +
                    '<p><a href="'+inner_route+'" class="btn btn-primary">Evaluar &nbsp;<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></a></p>' +
                    '</div>' +
                    '</div>';

                infowindow.push(new google.maps.InfoWindow({
                    content: contentString
                }));

                // PENDIENTE ----- aca hay q agregar el taller tambien en el if else------ var pinColor = @if( $p->type == 'shop' ) "FB7064" @else "65CEA7" @endif ;

                var pinColor = @if( $p->type == 'shop' ) "FE7569" @elseif($p->type == 'workshop') "01DF01" @else "FFFF00" @endif ;
                var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
                    new google.maps.Size(21, 34),
                    new google.maps.Point(0,0),
                    new google.maps.Point(10, 34));

                var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
                    new google.maps.Size(40, 37),
                    new google.maps.Point(0, 0),
                    new google.maps.Point(12, 35));


                marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                    icon: pinImage,
                    shadow: pinShadow,
                    title: "{{ $p->nombre }}",
                    id: cont
                });

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow[this.id].open(map, this);
                });

                cont ++;
            @endforeach
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    @if(Auth::check() && Session::get('welcome_msg_seen') == false)
    <script type="text/javascript">
        var mensaje = "Has iniciado sesión correctamente!";
        $.gritter.add({
            title: 'Información:',
            text: mensaje,
            time: 3000
        });
    </script>
    <?php echo Session::put('welcome_msg_seen', true) ?>
    @endif

    @if(Session::has('session_closed_msg'))
    <script type="text/javascript">
        var session_closed = "has cerrado tu sesión correctamente";
        $.gritter.add({
            title: 'Información:',
            text: session_closed,
            time: 3000
        });
    </script>
    @endif

@stop
