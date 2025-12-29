@extends('back.template.master')

@section('title', 'Quản lý danh sách slider')
@section('heading', 'Thêm slider')
@section('slider','active')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4" ><b>Thêm slider mới</b></h1>
 <div class="card-footer">
            <a href="{{ url('admin/slider/list') }} "><button type="submit" class="btn btn-primary">Quay lại</button></a>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{ url('admin/slider/add') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="Status" id="Status">
                                
                                <option value="0"  selected>Tắt</option>
                                <option value="1" selected>Kích hoạt</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="fullname">Tên slide show <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="Name" value="" placeholder="Tên tin tức">
                        </div>

                        <div class="form-group mb-3">
                            <label for="fullname">Đường dẫn<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Alias" id="slug" rows="4" readonly ></input>
                        </div>

                        <div class="form-group mb-3">
                            <label for="fullname">Sắp xếp<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="Sort" id="sort" rows="4" readonly ></input>
                        </div>
                        
                         <div class="form-group mb-3">
                            <label for="fullname">Ảnh đại diện<span class="text-danger">*</span></label>
                            <input type="file" name="images" class="form-control" />
                       
                                

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
