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
                        @if(isset($social))
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
                    {{-- <a href="{{ url('/') }}" class="home-icon"><i class="fa fa-home"></i></a> --}}
                    <nav class="navbar navbar-expand-lg p-0">
                        <div class="container-fluid">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @if(isset($Pages))
        @foreach ($Pages as $item)
            <li class="nav-item">
                {{-- LOGIC CHECK GIỐNG TRONG ẢNH --}}
                
                @if($item->Alias == '/')
                    {{-- Trường hợp là Trang chủ --}}
                    {{-- class="@yield('/')" nghĩa là nếu trang con có @section('/','active') thì thêm class active --}}
                    <a class="nav-link @yield('/')" href="{{ url($item->Alias) }}">
                        @if(isset($item->Font)) {!! $item->Font !!} @else {{ $item->Name }} @endif
                    </a>
                @else
                    {{-- Trường hợp là các trang con (Liên hệ, Giới thiệu...) --}}
                    {{-- class="@yield($item->Alias)" sẽ lấy nội dung từ section có tên trùng với Alias --}}
                    <a class="nav-link @yield($item->Alias)" href="{{ url($item->Alias) }}">
                        @if(isset($item->Font)) {!! $item->Font !!} @else {{ $item->Name }} @endif
                    </a>
                @endif
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