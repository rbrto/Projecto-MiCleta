<!-- header section start-->
<div class="header-section">

    <!--toggle button start-->
    <a class="toggle-btn"><i class="fa fa-bars"></i></a>
    <!--toggle button end-->

    @if(Entrust::hasRole('administrator'))
        <!--notification menu start -->
        <div class="menu-right">
            <ul class="notification-menu">
                <li>
                    <span>Bienvenido:</span> <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Administrador<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                        <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Cerrar Sesión</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <!--notification menu end -->
    @endif

    @if(Entrust::hasRole('user'))
    <!--notification menu start -->
    <div class="menu-right">
        <ul class="notification-menu">
            <li>
                <span>Bienvenido:</span> <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->nombre.' '.Auth::user()->apellido }}<span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                    <li><a href="{{ route('editProfile') }}"><i class="fa fa-user"></i>  Editar Mis Datos</a></li>
                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Cerrar Sesión</a></li>
                </ul>
            </li>

        </ul>
    </div>
    <!--notification menu end -->
    @endif
</div>
<!-- header section end-->