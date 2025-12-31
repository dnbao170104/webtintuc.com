@extends('back.template.master')

@section('title', 'Quản lý trang    ')
@section('heading', 'Chỉnh sửa trang')
@section('pages','active')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4" ><b>Chỉnh sửa thông tin trang</b></h1>
 <div class="card-footer">
            <a href="{{ url('admin/pages/list') }} "><button type="submit" class="btn btn-primary">Quay lại</button></a>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{ url('admin/pages/edit/' . $Pages->RowID) }}" method="POST">
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="Status" id="Status">
                                <option value="1" @if ($Pages->Status == 1) selected @endif>Kích hoạt</option>
                                <option value="0" @if ($Pages->Status == 0) selected @endif>Tắt</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fullname">Tên trang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="Name" value="{{ $Pages->Name }}"
                                   placeholder="Tên trang" onkeyup="ChangeToSlug();">
                        </div>
                         <div class="form-group mb-3">
                            <label for="fullname">Đường dẫn<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Alias" id="slug" rows="4" value="{{ $Pages->Alias }}" disabled></input>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Font <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="Font" name="Font"
                                 value="{{ $Pages->Font }}" placeholder="Font">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Sắp xếp</label>
                            <input type="text" class="form-control" id="Sort" name="Sort"
                                  value="{{ $Pages->Sort }}" placeholder="Sắp xếp">
                        </div>
                        <div class="form-group mb-3">
                            <label for="fullname">Thẻ meta title <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="MetaTitle" name="MetaTitle" rows="4" placeholder="Thẻ meta title">{{ $Pages->MetaTitle }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fullname">Thẻ MetaDescription <span class="text-danger">*</span></label>
                             <textarea class="form-control" id="MetaDescription" name="MetaDescription" rows="4" placeholder="Thẻ meta description" >{{ $Pages->MetaDescription }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fullname">Thẻ MetaKeywords <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="MetaKeywords" name="MetaKeyword" rows="4" placeholder="Thẻ meta keyword" >{{ $Pages->MetaKeyword }}</textarea>
                            </div>
                              <div>
                                <label for="fullname">Mô tả tin tức <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="ckeditor" name="Description" rows="4" placeholder="Mô tả tin tức" >{{ $Pages->Descripstion }}</textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection
