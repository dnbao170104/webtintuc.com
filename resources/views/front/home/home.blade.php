@extends('front.template.master')

@section('title', 'Trang chủ')
@section('description', 'Mô tả trang chủ')
@section('keywords', 'tin tuc, thoi trang')
@section('url', url('/'))

@section('content')
    @if(isset($slider) && count($slider) > 0)
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($slider as $key => $slide)
                <button type="button" data-bs-target="#carouselExampleIndicators" 
                        data-bs-slide-to="{{ $key }}" 
                        class="{{ $key == 0 ? 'active' : '' }}" 
                        aria-current="true"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($slider as $key => $slide)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <img src="{{ url('images/slider/'.$slide->Images) }}" class="d-block w-100" alt="{{ $slide->Name }}">
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $slide->Name }}</h5>
                    </div> --}}
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @endif

    <div class="container mt-4">
        <h3>Tin tức mới nhất</h3>
        </div>
@endsection