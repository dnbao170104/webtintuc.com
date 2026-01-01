@extends('front.template.master')

{{-- Cấu hình SEO cho bài viết --}}
@section('title', $newsDetail->MetaTitle ?? $newsDetail->Name)
@section('description', $newsDetail->MetaDescription ?? $newsDetail->SmallDescription)
@section('keywords', $newsDetail->MetaKeyword ?? '')
@section('url', url($newsDetail->Alias.'.html'))
@section('images', !empty($newsDetail->Images) ? url('images/news/'.$newsDetail->Images) : '')
@section($catAlias,'active')
@section('content')

<style>
    /* CSS riêng cho trang chi tiết */
    .news-detail-title {
        color: #333;
        font-weight: bold;
        font-size: 28px;
        line-height: 1.4;
    }
    
    .news-meta {
        color: #888;
        font-size: 14px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    
    .news-meta i {
        margin-right: 5px;
    }

    .news-content {
        font-size: 16px;
        line-height: 1.8;
        color: #444;
        text-align: justify;
    }
    
    /* Style cho ảnh trong bài viết để không bị vỡ khung */
    .news-content img {
        max-width: 100% !important;
        height: auto !important;
        display: block;
        margin: 20px auto;
        border-radius: 5px;
    }

    /* Phần bài viết liên quan */
    .related-title {
        font-size: 20px;
        font-weight: bold;
        text-transform: uppercase;
        border-left: 4px solid #ff6600;
        padding-left: 10px;
        margin-bottom: 20px;
        margin-top: 40px;
    }
    
    .related-item-title a {
        color: #333;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
        font-size: 15px;
    }
    .related-item-title a:hover {
        color: #ff6600;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            {{-- Breadcrumb (Đường dẫn) --}}
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-3">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}" class="text-decoration-none text-muted">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $catName ?? 'Tin tức' }}</li>
                </ol>
            </nav>

            {{-- 1. Tiêu đề bài viết --}}
            <h1 class="news-detail-title mb-3">{{ $newsDetail->Name }}</h1>

            {{-- 2. Thông tin ngày đăng & Lượt xem --}}
            <div class="news-meta d-flex gap-4">
                <span>
                    <i class="fa-regular fa-clock"></i> 
                    {{ date('d/m/Y', strtotime($newsDetail->created_at)) }}
                </span>
                <span>
                    <i class="fa-regular fa-eye"></i> 
                    {{ $newsDetail->Views }} lượt xem
                </span>
            </div>

            {{-- 3. Nội dung chi tiết (QUAN TRỌNG: Dùng {!! !!} để hiển thị HTML) --}}
            <div class="news-content mb-5">
                {{-- Hiển thị mô tả ngắn (in đậm) nếu có --}}
                @if(!empty($newsDetail->SmallDescription))
                    <div class="fw-bold fst-italic mb-4 text-dark">
                        {{ $newsDetail->SmallDescription }}
                    </div>
                @endif

                {{-- Nội dung chính --}}
                {!! $newsDetail->Description !!}
            </div>

            {{-- 4. Bài viết liên quan --}}
           {{-- 4. Bài viết liên quan --}}
            @if(isset($relatedNews) && count($relatedNews) > 0)
                <div class="related-section border-top pt-4">
                    <h3 class="related-title">Bài viết liên quan</h3>
                    <div class="row">
                        @foreach($relatedNews as $item)
                            <div class="col-md-3 col-6 mb-4">
                                <div class="related-item h-100">
                                    <div class="mb-2 overflow-hidden rounded">
                                        {{-- SỬA LINK Ở ĐÂY --}}
                                        <a href="{{ url($item->Alias ?? '') }}" title="{{ $item->Name }}">
                                            <img src="{{ !empty($item->Images) ? url('images/news/'.$item->Images) : 'https://via.placeholder.com/300x200' }}" 
                                                 class="w-100" 
                                                 alt="{{ $item->Name }}"
                                                 style="height: 150px; object-fit: cover;">
                                        </a>
                                    </div>
                                    <h5 class="related-item-title">
                                        {{-- SỬA LINK CẢ Ở ĐÂY NỮA --}}
                                        <a href="{{ url($item->Alias ?? '') }}">
                                            {{ Str::limit($item->Name, 50) }}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</div>

@endsection