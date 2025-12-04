<!-- resources/views/back/template/master.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <!-- Trong master.blade.php -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
    <title>Admin Dashboard</title>
    @include('back.template.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('back.template.navbar')
    @include('back.template.sidebar')
    
    <!-- Flash Messages -->
    <div class="content-wrapper">
        <section class="content">
    <div class="container-fluid">
        @if(Session::has('flash_message'))
            <div class="ad-message alert alert-{{ Session::get('flash_level') }}">
                {!! Session::get('flash_message') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- Main content -->
        @yield('content')
        <!-- /.content -->
    </div>
</section>
    </div>
    
    @include('back.template.footer')
</div>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap Bundle (gồm Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- OverlayScrollbars -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/overlayscrollbars/1.13.1/js/OverlayScrollbars.min.js"></script>

<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html><!-- resources/views/back/template/master.blade.php -->
