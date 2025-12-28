@extends('back.template.master')

@section('title', 'Quản lý danh sách tin tức')
@section('heading', 'Sửa tin tức')
@section('news_cat','active')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4" ><b>Chỉnh sửa thông tin tin tức</b></h1>
 <div class="card-footer">
            <a href="{{ url('admin/news/list') }} "><button type="submit" class="btn btn-primary">Quay lại</button></a>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{ url('admin/news/edit/' . $News->RowID) }}" method="POST">
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="Status" id="Status">
                                <option value="1" @if($News->Status == 1) selected @endif>Kích hoạt</option>
                                <option value="0" @if($News->Status == 0) selected @endif>Tắt</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="RowIDCat" id="RowIDCat">
                                @if(isset($NewsCategory) && count($NewsCategory) > 0)
                                    @foreach($NewsCategory as $cat)
                                        <option value="{{ $cat->RowID }}" @if($News->RowIDCat == $cat->RowID) selected @endif>Danh mục: {{ $cat->Name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="fullname">Tên tên tin tức <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="Name" name="Name" value="{{ $News->Name }}" placeholder="Tên tin tức">
                        </div>

                        <div class="form-group mb-3">
                            <label for="fullname">Thẻ meta title <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="MetaTitle" name="MetaTitle" rows="4" placeholder="Thẻ meta title">{{ $News->MetaTitle }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fullname">Thẻ MetaDescription <span class="text-danger">*</span></label>
                             <textarea class="form-control" id="MetaDescription" name="MetaDescription" rows="4" placeholder="Thẻ meta description" >{{ $News->MetaDescription }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fullname">Thẻ MetaKeywords <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="MetaKeywords" name="MetaKeyword" rows="4" placeholder="Thẻ meta keyword" >{{ $News->MetaKeyword }}</textarea>
                         {{-- <div class="form-group mb-3">
                            <label for="fullname">Giới thiệu ngắn <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="SmallDescription" name="SmallDescription" rows="4" placeholder="Giới thiệu ngắn" value="{{ $News->SmallDescription }}"></textarea>
                        </div> --}}
                         <div class="form-group mb-3">
                            <label for="fullname">Giới thiệu ngắn <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="SmallDescription" name="SmallDescription" rows="4" placeholder="Giới thiệu ngắn" >{{ $News->SmallDescription }}</textarea>
                        </div>
                                <label for="fullname">Mô tả tin tức <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="Description" name="Description" rows="4" placeholder="Mô tả tin tức" >{{ $News->Description }}</textarea>
                        </div>
                       
                                

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection
