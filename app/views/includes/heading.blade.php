<!-- page heading start-->

@if($header_title)
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-8">
                <div class="page-heading">
                    <h2>{{ $page_title }}</h2>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="pull-right">
                    @yield('top_button_bar')
                </div>
            </div>
        </div>
    </div>
</section>
<!-- page heading end-->
@endif