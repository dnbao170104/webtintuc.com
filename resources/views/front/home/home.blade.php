@extends('front.template.master')

@section('content')

<style>
    /* Tiêu đề mục có gạch dọc cam */
    .section-title { font-size: 18px; font-weight: bold; text-transform: uppercase; border-left: 5px solid #ff5722; padding-left: 10px; margin-bottom: 20px; color: #333; }
    
    /* Tin tức */
    .news-img { width: 100%; height: 180px; object-fit: cover; margin-bottom: 10px; }
    .news-title a { color: #ff5722; text-decoration: none; font-weight: bold; font-size: 16px; display: block; margin-bottom: 5px; }
    .news-title a:hover { color: #333; }
    .read-more { color: #ff5722; font-size: 13px; font-style: italic; text-decoration: none; }
    
    /* Sidebar */
    .about-img { width: 100%; margin-bottom: 15px; }
</style>

@if(isset($slider) && count($slider) > 0)
<div id="homeSlider" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach($slider as $key => $slide)
            <button type="button" data-bs-target="#homeSlider" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach($slider as $key => $slide)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <img src="{{ url('images/news_slider/'.$slide->Images) }}" 
     class="d-block w-100" 
     alt="{{ $slide->Name }}" 
     style="height: 500px; object-fit: cover; object-position: center;">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#homeSlider" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#homeSlider" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>
@endif

<div class="container py-5">
    <div class="row">
        
        <div class="col-lg-9 col-md-8">
            <h3 class="section-title">Blog mới nhất</h3>
            <div class="row">
                @if(isset($news) && count($news) > 0)
                    @foreach($news as $item)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="news-item">
                            <a href="{{ url('tin-tuc/'.$item->Alias) }}">
                                <img src="{{ url('images/news/'.$item->Images) }}" alt="{{ $item->Name }}" class="news-img">
                            </a>
                            <h4 class="news-title">
                                <a href="{{ url('tin-tuc/'.$item->Alias) }}">{{ \Illuminate\Support\Str::limit($item->Name, 50) }}</a>
                            </h4>
                            <p class="small text-muted mb-1">
                                {{ \Illuminate\Support\Str::limit($item->SmallDescription, 100) }}
                                <a href="{{ url('tin-tuc/'.$item->Alias) }}" class="read-more">[read more]</a>
                            </p>
                            
                        </div>
                    </div>
                    @endforeach
                @else
                    <p class="text-muted">Chưa có tin tức nào.</p>
                @endif
            </div>
        </div>

        <div class="col-lg-3 col-md-4">
            <h3 class="section-title">Về chúng tôi</h3>
            <div class="about-widget">
                <img src="{{ url('public/images/img7.jpg') }}" alt="About" class="about-img">
                <h5 class="text-warning fw-bold">Admin</h5>
                <p class="small text-muted">Chào mừng bạn đến với Website Tin tức công nghệ và đời sống...
                    <a href="{{ url('tin-tuc/'.$item->Alias) }}" class="read-more">[read more]</a>
                </p>
                <div class="social-icons mt-3">
                    <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="me-2"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container-fluid promotion-section">
    <div class="container">
        <h3 class="section-title">Khuyến mại mới nhất</h3>
        
        <div class="row">
            @if(isset($promotions) && count($promotions) > 0)
                @foreach($promotions as $item)
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="news-item promotion-item">
                        <a href="{{ url('tin-tuc/'.$item->Alias) }}">
                            <img src="{{ url('images/news/'.$item->Images) }}" alt="{{ $item->Name }}" class="news-img">
                        </a>
                        
                        <h4 class="news-title mt-3">
                            <a href="{{ url('tin-tuc/'.$item->Alias) }}">
                                {{ \Illuminate\Support\Str::limit($item->Name, 40) }}
                            </a>
                        </h4>
                        
                        <p class="small text-muted mb-2">
                            {{ \Illuminate\Support\Str::limit($item->SmallDescription, 80) }}
                            <a href="{{ url('tin-tuc/'.$item->Alias) }}" class="read-more">[read more]</a>
                        </p>
                        
                        
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-white">Chưa có chương trình khuyến mại nào.</p>
            @endif
        </div>
    </div>
</div>
<div class="container py-5">
    <h3 class="section-title">Blog xem nhiều</h3>
    
    <div class="row">
        @if(isset($hot_news) && count($hot_news) > 0)
            @foreach($hot_news as $item)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="news-item">
                    <a href="{{ url('tin-tuc/'.$item->Alias) }}">
                        <img src="{{ url('images/news/'.$item->Images) }}" alt="{{ $item->Name }}" class="news-img">
                    </a>
                    
                    <h4 class="news-title mt-3">
                        <a href="{{ url('tin-tuc/'.$item->Alias) }}">
                            {{ \Illuminate\Support\Str::limit($item->Name, 50) }}
                        </a>
                    </h4>
                    
                    <p class="small text-muted mb-2">
                        {{ \Illuminate\Support\Str::limit($item->SmallDescription, 100) }}
                    </p>
                    
                    <a href="{{ url('tin-tuc/'.$item->Alias) }}" class="read-more">[read more]</a>
                </div>
            </div>
            @endforeach
        @else
            <p>Chưa có tin tức nổi bật.</p>
        @endif
    </div>
</div>
@endsection