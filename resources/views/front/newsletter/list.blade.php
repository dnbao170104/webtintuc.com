@extends('back.template.master')

@section('title', 'Quan lý khuyến mãi')
@section('heading', 'Danh sách khuyến mãi')
@section('newsletter','active')

@section('content')

    <h1 class="mb-4">Quản lý khuyến mãi</h1>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Danh sách khuyến mãi</b></h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
    <tr>
        <th style="width: 10px">STT</th>
        <th>Tên trang</th>
        <th>Trạng thái</th>
        <th><i class="fas fa-wrench"></i></th>
    </tr>
</thead>

<tbody>

    @if (isset($Newsletter) && count($Newsletter) > 0)
        
        
        @foreach($Newsletter as $key => $row)
        <tr>
           <td>{{ $key + 1 }}</td>
            <td>{{ $row ->Email}}</td>

            
            <td>@if ($row->IsViews==1)
                <span class="badge badge-success">Đã xem</span>
            @else
                <span class="badge badge-danger">Chưa xem</span>
                
            @endif</td>

            <td>
                <a href="{{ url('admin/newsletter/edit/' . $row->RowID) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <a href="{{ url('admin/newsletter/delete/' . $row->RowID) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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