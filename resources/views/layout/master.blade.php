<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>Shahjalal Enterprise</title>

    <link href="{{ asset('assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/build/css/custom.min.css') }}" rel="stylesheet">


    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    <!-- Datatables -->

    <link href="{{ asset('assets/admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('assets/admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}"
        rel="stylesheet">
    @yield('style')
    @yield('styles')
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            @include('layout.sidebar', ['user' => Auth::user()])


            <!-- top navigation -->
            @include('layout.top_nav', ['user' => Auth::user()])

            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <script src="{{ asset('assets/admin/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/nprogress/nprogress.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/skycons/skycons.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/DateJS/build/date.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/admin/build/js/custom.min.js') }}"></script>


    <!-- Datatables -->
    <script src="{{ asset('assets/admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/pdfmake/build/vfs_fonts.js') }}"></script>


    @yield('script')
    @yield('scripts')

    <script>

            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    var flashMessage = document.getElementById('flash-message');
                    if (flashMessage) {
                        flashMessage.style.transition = 'opacity 0.5s ease';
                        flashMessage.style.opacity = '0';
                        setTimeout(function() {
                            flashMessage.remove();
                        }, 500);
                    }
                }, 3000);
            });
    </script>

</body>

</html>
