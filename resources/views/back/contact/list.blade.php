@extends('back.template.master')

@section('title', 'Quản lý liên hệ')
@section('heading', 'Danh sách liên hệ')
@section('contact','active')

@section('content')

    <h1 class="mb-4">Quản lý liên hệ</h1>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Danh sách liên hệ</b></h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
    <tr>
        <th style="width: 10px">STT</th>
        <th>Họ và tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Trạng thái</th>
        <th><i class="fas fa-wrench"></i></th>
    </tr>
</thead>

<tbody>

    @if (isset($Contact) && count($Contact) > 0)
        
        
        @foreach($Contact as $key => $row)
        <tr>
           <td>{{ $key + 1 }}</td>
           <td>{{ $row ->Name}}</td>
            <td>{{ $row ->Email}}</td>
            <td>{{ $row ->Phone}}</td>

            
            <td>@if ($row->IsViews==1)
                <span class="badge badge-success">Đã xem</span>
            @else
                <span class="badge badge-danger">Chưa xem</span>
                
            @endif</td>

            <td>
                <a href="{{ url('admin/contact/edit/' . $row->RowID) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <a href="{{ url('admin/contact/delete/' . $row->RowID) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
        @endforeach

    @else
        {{-- Trường hợp không có dữ liệu --}}
        <tr>
            <td colspan="6" class="text-center">Không có dữ liệu</td>
        </tr>
    @endif
</tbody>
            </table>
        </div>
        <!-- /.card-body -->
</div>



@endsection