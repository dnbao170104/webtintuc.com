@extends('back.template.master')

@section('title', 'Quản lý nhân viên')
@section('heading', 'Thêm nhân viên')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4">Thông tin tài khoản</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                
                <form role="form" method="POST" action="{{ url('admin/staff/add') }}" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="level" id="level">
                                @if(isset($UserLevel)&&count($UserLevel)>0)
                                    @foreach($UserLevel as $level)
                                        <option value="{{ $level->id }}">Cấp bậc: {{ $level->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="fullname">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                   placeholder="Họ và tên">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Số điện thoại">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Địa chỉ">
                        </div>

                        <div class="form-group mb-3">
                            <label for="username">Tài khoản</label>
                            <input type="text" class="form-control" id="username" name="username"
                                   placeholder="Tài khoản">
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