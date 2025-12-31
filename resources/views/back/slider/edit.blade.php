@extends('back.template.master')

@section('title', 'Quản lý danh sách slider')
@section('heading', 'Sửa slider')
@section('slide','active')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4" ><b>Chỉnh sửa thông tin slider</b></h1>
 <div class="card-footer">
            <a href="{{ url('admin/slider/list') }} "><button type="submit" class="btn btn-primary">Quay lại</button></a>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{ url('admin/slider/edit/' . $Slider->RowID) }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="Status" id="Status">
                                <option value="1" @if($Slider->Status == 1) selected @endif>Kích hoạt</option>
                                <option value="0" @if($Slider->Status == 0) selected @endif>Tắt</option>
                            </select>
                        </div>

                        

                       
                        <div class="form-group mb-3">
                            <label for="fullname">Tên slider <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="Name" value="{{ $Slider->Name }}" placeholder="Tên slider" onkeyup="ChangeToSlug();">
                            </div>
                        <div class="form-group mb-3">
                            <label for="fullname">Đường dẫn<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Alias" id="slug" rows="4" value="" disabled></input>
                        </div>
                         <div class="form-group mb-3">
                            <label for="fullname">Sắp xếp<span class="text-danger"></span></label>
                            <input type="text" class="form-control" name="Sort" id="sort" rows="4" value="{{ $Slider->Sort }}" ></input>
                        </div>
                         <div class="form-group mb-3">
                            <label for="fullname">Ảnh đại diện<span class="text-danger">*</span></label><br>
                            @if($Slider->Images!=null)
                            <img src="{{ asset('images/news_slider/' . $Slider->Images) }}" alt="Ảnh tin tức" width="150" />
                            @endif
                            <input type="file" name="images" class="form-control" />
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
