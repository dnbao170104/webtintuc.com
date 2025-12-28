@extends('back.template.master')

@section('title', 'Quản lý danh sách tin tức')
@section('heading', 'Thêm tin tức')
@section('news_cat','active')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4" ><b>Chỉnh sửa thông tin trang</b></h1>
 <div class="card-footer">
            <a href="{{ url('admin/news/list') }} "><button type="submit" class="btn btn-primary">Quay lại</button></a>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{ url('admin/news/add') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="Status" id="Status">
                                <option value="1" selected>Kích hoạt</option>
                                <option value="0"  selected>Tắt</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="RowIDCat" id="RowIDCat">
                                @if(isset($NewsCategory) && count($NewsCategory) > 0)
                                    @foreach($NewsCategory as $cat)
                                        <option value="{{ $cat->RowID }}">{{ $cat->Name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="fullname">Tên tên tin tức <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="Name" value="" placeholder="Tên tin tức" onkeyup="ChangeToSlug();">
                        </div>

                        <div class="form-group mb-3">
                            <label for="fullname">Đường dẫn<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Alias" id="slug" rows="4" disabled ></input>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fullname">Thẻ MetaDescription <span class="text-danger">*</span></label>
                             <textarea class="form-control" id="MetaDescription" name="MetaDescription" rows="4" placeholder="Thẻ meta description"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fullname">Thẻ MetaKeywords <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="MetaKeywords" name="MetaKeywords" rows="4" placeholder="Thẻ meta keywords"></textarea>
                            </div>
                         <div class="form-group mb-3">
                            <label for="fullname">Giới thiệu ngắn <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="SmallDescription" name="SmallDescription" rows="4" placeholder="Giới thiệu ngắn"></textarea>
                        </div>

                        
                         <div class="form-group mb-3">
                            <label for="fullname">Ảnh đại diện<span class="text-danger">*</span></label>
                            <input type="file" name="images" class="form-control" />
                        </div>
                                <label for="fullname">Mô tả tin tức <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="ckeditor" name="Description" rows="4" placeholder="Mô tả tin tức"></textarea>
                        </div>
                       
                                

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection
