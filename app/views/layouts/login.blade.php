<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes.head')
    @yield('additional_plugins')
</head>

<body class="login-body">
    <div class="container">
        @section('main_content')

        @show
    </div>
    <!-- Placed js at the end of the document so the pages load faster -->
    {{ HTML::script('js/jquery-1.10.2.min.js') }}
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/modernizr.min.js') }}
</body>
</html>
