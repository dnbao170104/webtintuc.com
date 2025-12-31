@extends('back.template.master')

@section('title', 'Quan lý trang')
@section('heading', 'Danh sách trang')
@section('page','active')

@section('content')

    <h1 class="mb-4">Quản lý trang</h1>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Danh sách trang</b></h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
    <tr>
        <th style="width: 10px">STT</th>
        <th>Tên trang</th>
        <th>Trạng thái</th>
        <th>Sắp xếp</th>
        <th><i class="fas fa-wrench"></i></th>
    </tr>
</thead>

<tbody>
   
    @if (isset($Pages) && count($Pages) > 0)
        
        
        @foreach($Pages as $key => $row)
        <tr>
           <td>{{ $key + 1 }}</td>
            <td>{{ $row ->Name}}</td>

            
            <td>@if ($row->Status==1)
                <span class="badge badge-success">Kích hoạt</span>
            @else
                <span class="badge badge-danger">Khóa</span>
                
            @endif</td>

            <td>{{ $row ->Sort}}</td>

            <td>
                <a href="{{ url('admin/pages/edit/' . $row->RowID) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
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