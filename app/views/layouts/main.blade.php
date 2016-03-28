<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    @yield('additional_plugins')
</head>
<body class="sticky-header">

    <section>
        @include('includes.main_menu')

        <!-- main content start-->
        <div class="main-content" >
            @include('includes.header')


            <!--body wrapper start-->
            <div class="wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        @include('includes.heading')
                        @section('main_content')

                        @show
                    </div>
                </div>
            </div>
            <!--body wrapper end-->

        </div>
        <!-- main content end-->
    </section>

    <!-- Placed js at the end of the document so the pages load faster -->
    {{ HTML::script('js/jquery-1.10.2.min.js') }}
    {{ HTML::script('js/jquery-ui-1.9.2.custom.min.js') }}
    {{ HTML::script('js/jquery-migrate-1.2.1.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/modernizr.min.js') }}
    {{ HTML::script('js/jquery.nicescroll.js') }}

    <!--data table-->
    {{ HTML::script('js/data-tables/jquery.dataTables.js') }}
    {{ HTML::script('js/data-tables/DT_bootstrap.js') }}

    <!--common scripts for all pages-->
    {{ HTML::script('js/scripts.js') }}

    <!--gritter script-->
    {{ HTML::script('js/gritter/js/jquery.gritter.js') }}
    {{ HTML::script('js/gritter/js/gritter-init.js') }}

    @yield('bottom_js')
</body>
</html>