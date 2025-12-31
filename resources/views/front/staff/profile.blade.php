@extends('back.template.master')

@section('title', 'Thông tin tài khoản nhân viên')
@section('heading', 'Thông tin tài khoản nhân viên')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4">Thông tin tài khoản</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                
                <form role="form" method="POST" action="{{ url('admin/staff/profile') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    <div class="card-body">

                        <div class="form-group mb-3">
                            <label for="fullname">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                   value="{{ Auth::user()->fullname ?? '' }}" placeholder="Họ và tên">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ Auth::user()->email ?? '' }}" placeholder="Email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   value="{{ Auth::user()->phone ?? '' }}" placeholder="Số điện thoại">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ Auth::user()->address ?? '' }}" placeholder="Địa chỉ">
                        </div>

                        <div class="form-group mb-3">
                            <label for="username">Tài khoản</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   value="{{ Auth::user()->username ?? '' }}" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Password">
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