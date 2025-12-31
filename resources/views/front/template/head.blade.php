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
                                            @if(isset($item->Font))
                                                <a class="nav-link" href="{{ url($item->Alias) }}">{!! $item->Font !!} </a>
                                            @else
                                                <a class="nav-link" href="{{ url($item->Alias) }}">{{ $item->Name }}</a>
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