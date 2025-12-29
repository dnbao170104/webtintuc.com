<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <link rel="canonical" href="@yield('url')" />
    
    @if(isset($favicon))
    <link rel="shortcut icon" href="{{ url('images/favicon/'.$favicon->Description) }}" />
    @endif
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
       
    </style>
</head>

<body>
    <div class="header_top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="{{ url('/') }}">
                        @if(isset($logo))
                            <img src="{{ url('images/logo/'.$logo->Description) }}" alt="Logo" style="max-height: 80px;">
                        @else
                            <h2>LOGO</h2>
                        @endif
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <div class="social-icons">
                        @if(isset($social) && count($social) > 0)
                            @foreach ($social as $item)
                                <a href="{{ $item->Alias }}" target="_blank">{!! $item->Font !!}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-9 p-0 d-flex align-items-center">
                    <a href="{{ url('/') }}" class="home-icon"><i class="fa fa-home"></i></a>
                    <nav class="navbar navbar-expand-lg p-0">
                        <div class="container-fluid">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @if(isset($Pages) && count($Pages) > 0)
                                    @foreach ($Pages as $item)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $item->Alias }}">{{ $item->Name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-md-3">
                    <form action="" method="GET" class="search-box">
                        <input type="text" placeholder="Tìm kiếm...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>

    @include('front.template.footer') <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('script')
</body>
</html>