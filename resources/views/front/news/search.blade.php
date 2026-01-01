@extends('front.template.master')

{{-- Cấu hình SEO đơn giản cho trang tìm kiếm --}}
@section('title', 'Tìm kiếm: ' . $key)
@section('description', 'Kết quả tìm kiếm cho từ khóa ' . $key)
@section('url', route('search', ['key' => $key]))

@section('content')

<style>
    /* CSS Tái sử dụng từ trang cat.blade.php */
    .news-title a { color: #ff6600; font-weight: bold; font-size: 16px; text-decoration: none; transition: 0.3s; }
    .news-title a:hover { color: #333; }
    .news-desc { color: #666; font-size: 13px; line-height: 1.5; margin-bottom: 0; }
    .read-more { color: #ff6600 !important; font-size: 12px; text-decoration: none; margin-left: 5px; }
    .read-more:hover { text-decoration: underline; }
    
    .search-header {
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        padding-bottom: 10px;
    }
    .search-title {
        font-size: 20px;
        color: #444;
    }
    .search-keyword {
        color: #ff6600;
        font-weight: bold;
        font-style: italic;
    }
</style>

<div class="container py-4">
    {{-- Header hiển thị từ khóa đang tìm --}}
    <div class="search-header">
        <h1 class="search-title mb-0">
            Kết quả tìm kiếm cho: <span class="search-keyword">"{{ $key }}"</span>
        </h1>
        <p class="text-muted mt-2 mb-0">Tìm thấy {{ $listNews->total() }} bài viết.</p>
    </div>

    {{-- Lưới tin tức (Copy từ cat.blade.php sang) --}}
    <div class="row mt-4">
        @if(isset($listNews) && count($listNews) > 0)
            @foreach($listNews as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="news-item h-100">
                        {{-- Hình ảnh --}}
                        <div class="mb-2" style="height: 180px; overflow: hidden; background: #f1f1f1;">
                            {{-- Sử dụng Alias để link --}}
                            <a href="{{ url($item->Alias ?? '') }}" title="{{ $item->Name }}">
                                <img src="{{ !empty($item->Images) ? url('images/news/'.$item->Images) : 'https://via.placeholder.com/300x200' }}" 
                                     class="w-100 h-100" 
                                     alt="{{ $item->Name }}"
                                     style="object-fit: cover;">
                            </a>
                        </div>

                        {{-- Tiêu đề --}}
                        <h3 class="news-title mt-2 mb-1">
                            <a href="{{ url($item->Alias ?? '') }}">
                                {{ Str::limit($item->Name, 50) }}
                            </a>
                        </h3>

                        {{-- Mô tả --}}
                        <div class="news-desc">
                            {{ Str::limit($item->SmallDescription ?? 'Đang cập nhật...', 90) }}
                            <a href="{{ url($item->Alias ?? '') }}" class="read-more">[xem thêm]</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <i class="fa-solid fa-magnifying-glass fa-3x text-muted mb-3"></i>
                <h3>Không tìm thấy bài viết nào!</h3>
                <p class="text-muted">Vui lòng thử lại với từ khóa khác.</p>
            </div>
        @endif
    </div>

    {{-- Phân trang --}}
    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $listNews->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection