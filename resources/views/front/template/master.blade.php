<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title', 'Trang chủ')</title>
    
    @if(isset($favicon))
    <link rel="shortcut icon" href="{{ url('images/favicon/'.$favicon->Description) }}" />
    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
    
</head>

<body>
    @include('front.template.head')

    <div class="content">
        @yield('content')
    </div>

    @include('front.template.footer')

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>
</html>