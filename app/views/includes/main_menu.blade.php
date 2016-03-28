 left side start-->
<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <a href="{{ route('home') }}"><img src="{{asset('images/logo.png')}}" alt=""></a>
    </div>

    <div class="logo-icon text-center">
        <a href="{{ route('home') }}"><img src="{{asset('images/logo_icon.png')}}" alt=""></a>
    </div>
    <!--logo and iconic logo end-->

    <div class="left-side-inner">

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">

            <!-- HOME -->
            <li><a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Inicio</span></a></li> 

            <!-- VIDEO AYUDA -->
            <li class="menu-list">
                    <a href="">
                       <i class="fa fa-video-camera"></i><span>Video Ayuda</span>
                    </a>
                    <ul class="sub-menu-list">

                         @if(Entrust::hasRole('administrator'))
                          <li><a href="{{ route('showVideos') }}"> Mostrar Videos </a></li>
                         @else
                          <li><a href="{{url('video')}}"> Mostrar Videos</a></li>
                          @endif

                       @if(Entrust::hasRole('user'))
                          <li><a href="{{ route('video.create') }}"> Publicar Video</a></li>
                          <?php $id= Auth::user()->id ?>
                          <li><a href="{{ route('video.show',array($id)) }}"> Mis Videos</a></li>
                        @endif

                    </ul>
                </li> 


            <!-- Listado de Lugares-->
            <!-- <li class="menu-list"><a href=""><i class="fa fa-search"></i> <span>Buscar Marcador</span></a>
                <ul class="sub-menu-list">
                        
                        <li><a href="{{ route('home') }}"> Tiendas</a></li>
                        <li><a href="{{ route('home') }}"> Talleres</a></li>
                        <li><a href="{{ route('home') }}"> Estacionamientos</a></li>
                    </ul>
            </li> -->

            <!-- COMENTARIOS -->
            <li><a href="{{ route('comments') }}"><i class="fa fa-comments"></i> <span>Comentarios</span></a></li>

            <!-- REGISTRO -->
            <li><a href="{{ route('signup') }}"><i class="fa fa-users"></i> <span>Registro</span></a></li>

            <!-- MENU DE PERFIL USUARIOS REGISTRADOS-->
            @if(Entrust::hasRole('user'))
                <li class="menu-list nav-active">
                    <a href="">
                        <i class="fa fa-cogs"></i> <span>Mi Perfil</span>
                    </a>
                    <ul class="sub-menu-list">
                        <li><a href="{{ route('editProfile') }}"> Editar Mis Datos</a></li>
                        <li><a href="{{ route('editPassword') }}"> Cambiar Contraseña</a></li>
                        <li><a href="{{ route('createShopFrm') }}"> Ingresar Tiendas</a></li>
                        <li><a href="{{ route('createParkingFrm') }}"> Ingresar Estacionamientos</a></li>
                        <li><a href="{{ route('createWorkshopFrm') }}"> Ingresar Taller de Reparacion</a></li>
                    </ul>
                </li>
            @endif

            @if(Entrust::hasRole('administrator'))
                <li class="menu-list">
                    <a href="">
                        <i class="fa fa-cogs"></i> <span>Administrar</span>
                    </a>
                    <ul class="sub-menu-list">
                        <li><a href="{{ route('adminComments') }}"> Aprobación de Comentarios</a></li>
                    </ul>

                    <ul class="sub-menu-list">
                        <li><a href="{{ route('adminPlaces') }}"> Aprobación de Lugares</a></li>
                    </ul>

                    <ul class="sub-menu-list">
                    <li><a href="{{ route('adminVideos') }}"> Aprobación de Videos</a></li>
                    </ul>
                </li>
            @endif

            <!-- LOGIN -->
            @if(Auth::check())
                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> <span>Cerrar Sesión</span></a></li>
            @else
                <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> <span>Iniciar Sesión</span></a></li>
            @endif

        </ul>
        <!--sidebar nav end-->

    </div>
</div>
<!-- left side end