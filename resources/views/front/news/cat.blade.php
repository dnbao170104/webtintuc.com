@extends('front.template.master')

{{-- Khai báo các thẻ SEO --}}
@section('title', $newsCat->Name ?? 'Tin tức')
@section('description', $newsCat->MetaDescription ?? '')
@section('keywords', $newsCat->MetaKeyword ?? '')
@section('url', url($newsCat->Alias ?? ''))
@section('images', !empty($newsCat->Images) ? url('images/category/'.$newsCat->Images) : '')
@section($newsCat->Alias,'action')
@section('content')
    
{{-- CSS giữ nguyên như bạn đã viết --}}
<style>
    .news-title a { color: #ff6600; font-weight: bold; font-size: 16px; text-decoration: none; transition: 0.3s; }
    .news-title a:hover { color: #333; }
    .news-desc { color: #666; font-size: 13px; line-height: 1.5; margin-bottom: 0; }
    .read-more { color: #ff6600 !important; font-size: 12px; text-decoration: none; margin-left: 5px; }
    .read-more:hover { text-decoration: underline; }
    .cat-header { border-bottom: 1px solid #ddd; margin-bottom: 20px; padding-bottom: 10px; }
    .cat-title { font-size: 18px; font-weight: bold; color: #444; text-transform: uppercase; border-left: 4px solid #ff6600; padding-left: 10px; }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-end cat-header">
        <h1 class="cat-title mb-0">{{ $newsCat->Name ?? 'Danh mục' }}</h1>
        <div class="sort-box">
            <select id="sort-select" class="form-select form-select-sm" style="width: 150px; border-radius: 0;">
                <option selected>Sắp xếp theo</option>
                <option value="new">Mới nhất</option>
                <option value="views">Lượt xem</option>
            </select>
        </div>
    </div>

    <div class="row">
        @if(isset($listNews) && count($listNews) > 0)
            @foreach($listNews as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="news-item h-100">
                        {{-- 1. Hình ảnh --}}
                        <div class="mb-2" style="height: 180px; overflow: hidden; background: #f1f1f1;">
                            {{-- SỬA: Bỏ .html --}}
                            <a href="{{ url('/'.$item->Alias) }}" title="{{ $item->Name }}">
                                <img src="{{ !empty($item->Images) ? url('images/news/'.$item->Images) : 'https://via.placeholder.com/300x200' }}" 
                                     class="w-100 h-100" 
                                     alt="{{ $item->Name }}"
                                     style="object-fit: cover;">
                            </a>
                        </div>

                        {{-- 2. Tiêu đề --}}
                        <h3 class="news-title mt-2 mb-1">
                            {{-- SỬA: Bỏ .html --}}
                            <a href="{{ url('/'.$item->Alias) }}">
                                {{ Str::limit($item->Name, 50) }}
                            </a>
                        </h3>

                        {{-- 3. Mô tả --}}
                        <div class="news-desc">
                            {{ Str::limit($item->SmallDescription ?? 'Nội dung đang cập nhật...', 90) }}
                            {{-- Link này bạn đã viết đúng (không có .html) --}}
                            <a href="{{ url('/'.$item->Alias) }}" class="read-more">[read more]</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <p class="text-muted">Chưa có bài viết nào trong danh mục này.</p>
            </div>
        @endif
    </div>

    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-center">
            {{ $listNews->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sortSelect = document.getElementById('sort-select');

        // 1. Bắt sự kiện khi người dùng thay đổi lựa chọn
        if (sortSelect) {
            sortSelect.addEventListener('change', function() {
                const value = this.value;
                // Lấy URL hiện tại
                const url = new URL(window.location.href);

                // Cập nhật tham số ?sort=... trên URL
                if (value === 'views') {
                    url.searchParams.set('sort', 'views');
                } else if (value === 'new') {
                    url.searchParams.set('sort', 'new');
                } else {
                    // Nếu chọn "Sắp xếp theo" thì xóa tham số sort
                    url.searchParams.delete('sort');
                }

                // Chuyển hướng trang web
                window.location.href = url.toString();
            });

            // 2. Giữ trạng thái của ô select sau khi tải lại trang
            // (Để người dùng biết mình đang xem theo chế độ nào)
            const params = new URLSearchParams(window.location.search);
            const currentSort = params.get('sort');
            
            if (currentSort === 'views') {
                sortSelect.value = 'views';
            } else if (currentSort === 'new') {
                sortSelect.value = 'new';
            }
        }
    });
</script>
@endsection