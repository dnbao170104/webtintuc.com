@extends('back.template.master')

@section('title', 'Quan lý nhân viên')
@section('heading', 'Danh sách nhân viên')

@section('content')

    <h1 class="mb-4">Quản lý nhân viên</h1>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Danh sách nhân viên</h3>
        </div>
        <a href="{{ url('admin/staff/add') }} "><button type="button" class="btn btn-block btn-primary" width="10px" ><b>Thêm nhân viên mới</b></button></a>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
    <tr>
        <th style="width: 10px">STT</th>
        <th>Họ và tên</th>
        <th>Cấp bậc</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Hành động</th>
    </tr>
</thead>

<tbody>
    {{-- Kiểm tra biến tồn tại và có dữ liệu --}}
    @if (isset($User) && count($User) > 0)
        
        {{-- SỬA LẠI CÚ PHÁP FOREACH --}}
        @foreach($User as $key => $row)
        <tr>
            {{-- STT: Lấy key + 1 (vì key bắt đầu từ 0) --}}
            <td>{{ $key + 1 }}</td>

            {{-- Các thông tin khác lấy từ biến $row --}}
            <td>{{ $row->fullname }}</td>
            
            <td>
                {{-- Dùng level_name đã đặt alias trong controller --}}
                <span class="badge badge-info">{{ $row->level_name }}</span>
            </td>

            <td>{{ $row->email }}</td>
            <td>{{ $row->phone }}</td>

            <td>
                {{-- Nút Sửa/Xóa (cần ID để hoạt động sau này) --}}
                <a href="{{ url('admin/staff/edit/' . $row->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
        @endforeach

    @else
        {{-- Trường hợp không có dữ liệu --}}
        <tr>
            <td colspan="6" class="text-center">Không có dữ liệu nhân viên</td>
        </tr>
    @endif
</tbody>
            </table>
        </div>
        <!-- /.card-body -->
</div>



@endsection