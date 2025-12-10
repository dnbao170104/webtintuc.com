@extends('back.template.master')

@section('title', 'Quản lý nhân viên')
@section('heading', 'Chỉnh sửa nhân viên')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4" ><b>Chỉnh sửa thông tin tài khoản</b></h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{ url('admin/staff/edit/' . $User->id) }}" method="POST">
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="level" id="level">
                                @if(isset($UserLevel)&&count($UserLevel)>0)
                                    @foreach($UserLevel as $level)
                                        <option value="{{ $level->id }}" @if($level->id==$User->id) selected=""@endif>
                                            Cấp bậc: {{ $level->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                         {{-- <div class="form-group">
                            <select class="form-control" name="level" id="level">
                               
                                   
                                        <option value="1"  @if($User->status==1) selected=""@endif> 
                                            Trạng thái: Bật
                                        </option>
                                        <option value=""  @if($User->status==1) selected=""@endif> 
                                            Trạng thái: Tắt
                                        </option>
                                  
                                
                            </select>
                        </div> --}}
                        <div class="form-group mb-3">
                            <label for="fullname">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $User->fullname }}"
                                   placeholder="Họ và tên">
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                   value="{{ $User->email }}" placeholder="Email">
                        </div>

                        <div class="form-group mb-3">
                            <label for="phone">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                  value="{{ $User->phone }}"  placeholder="Số điện thoại">
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   value="{{ $User->address }}" placeholder="Địa chỉ">
                        </div>

                        <div class="form-group mb-3">
                            <label for="username">Tài khoản</label>
                            <input type="text" class="form-control" id="username" name="username"
                                  value="{{ $User->username }}" placeholder="Tài khoản" disabled value="{{ $User->username }}">
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
