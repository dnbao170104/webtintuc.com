@extends('front.template.master')
@section('title', $PageInfo->Name)
@section('description', $PageInfo->MetaDescription)
@section('keywords',$PageInfo->MetaKeyword)
@section('title', $PageInfo->Name ?? 'Liên hệ') 
@section('url', url('ve-chung-toi'))
@section('images', url('images/page/'.$PageInfo->Images ?? ''))

@section('ve-chung-toi', 'active')
@section('content')
<div class="container py-5">
    {{-- Phần tiêu đề giữ nguyên --}}
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="border-start border-4 border-warning ps-3">{{ $PageInfo->Name }}</h2>
            <p class="text-muted mt-3">
                {{ $PageInfo->Description }}
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            
        </div>
    </div>

</div>
@endsection