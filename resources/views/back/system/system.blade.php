@extends('back.template.master')

@section('title', 'Cấu hình hệ thống')
@section('heading', 'Cấu hình hệ thống')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4"><b>Cấu hình hệ thống</b></h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                
                <form role="form" method="POST" action="{{ url('admin/system') }}" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                      
                        <div class="form-group mb-3">
                            <label for="fullname">Tên công ty <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $name->Description }}"
                                   placeholder="Tên công ty">
                        </div>

                        <div class="form-group mb-3">
                            <label >Logo</label> <br>
                            <img src="{{ url ('images/logo/'.$logo->Description) }}" alt="logo" >
                            <input type="file" class="form-control" name="logo">
                        </div>

                        <div class="form-group mb-3">
                            <label >Favicon</label><br>
                            <img src="{{ url ('images/favicon/'.$favicon->Description) }}" alt="favicon" >
                            <input type="file" class="form-control"  name="favicon "
                                  >
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $email->Description }}"
                                    placeholder="Email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $phone->Description }}"
                                    placeholder="Số điện thoại">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $address->Description }}"
                                    placeholder="Địa chỉ">
                        </div>

                        <div class="form-group mb-3">
                            <label for="username">Coppyright</label>
                            <input type="text" class="form-control"  name="copyright" value="{{ $copyright->Description }}"
                                    >
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