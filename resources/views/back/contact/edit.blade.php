@extends('back.template.master')

@section('title', 'Quản lý liên hệ')
@section('heading', 'Chỉnh sửa liên hệ')
@section('contact','active')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4" ><b>Chỉnh sửa thông tin liên hệ</b></h1>
 <div class="card-footer">
            <a href="{{ url('admin/contact/list') }} "><button type="submit" class="btn btn-primary">Quay lại</button></a>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{ url('admin/contact/edit/' . $Contact ->RowID) }}" method="POST">
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="Status" id="Status">
                                <option value="1" @if ($Contact->IsViews == 1) selected @endif>Đã xem</option>
                                <option value="0" @if ($Contact ->IsViews == 0) selected @endif>Chưa xem</option>
                            </select>
                        </div>
                         <div class="form-group mb-3">
                            <label for="Name">Họ và tên<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="Name" name="Name" value="{{ $Contact->Name }}"
                                   placeholder="Họ và tên">
                        </div>
                        <div class="form-group mb-3">
                            <label for="Email">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="Email" name="Email" value="{{ $Contact->Email }}"
                                   placeholder="Email">
                        </div>
                         <div class="form-group mb-3">
                            <label for="Phone">Số điện thoại<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="Phone" name="Phone" value="{{ $Contact->Phone }}"
                                   placeholder="Số điện thoại">
                        </div>
                         <div class="form-group mb-3">
                            <label for="Email">Lời nhắn<span class="text-danger">*</span></label>
                            <textarea class="form-control" rows="7" readonly >{{ $Contact->Message }}</textarea> 
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
