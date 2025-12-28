@extends('back.template.master')

@section('title', 'Quan lý tin tức')
@section('heading', 'Danh sách tin tức')
@section('news','active')

@section('content')

    <h1 class="mb-4">Quản lý tin tức</h1>
    <div class="card-footer">
            <a href="{{ url('admin/news/add') }} "><button type="submit" class="btn btn-primary">Thêm tin tức</button></a>
        </div>
        </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Danh sách danh mục tin tức</b></h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
    <tr>
        <th style="width: 10px">STT</th>
        <th>Tên tin tức</th>
        <th>Thuộc danh mục</th>
        <th><i class="fas fa-wrench"></i></th>
    </tr>
</thead>

<tbody>

    @if (isset($News) && count($News    ) > 0)
        
        
        @foreach($News as $key => $row)
        <tr>
           <td>{{ $key + 1 }}</td>
            <td>{{ $row ->Name}}</td>
            <td>{{ $row ->CatName}}</td>
            
            <td>@if ($row->Status==1)
                <span class="badge badge-success">Kích hoạt</span>
            @else
                <span class="badge badge-danger">Khóa</span>
                
            @endif</td>
            <td>
                <a href="{{ url('admin/news/edit/' . $row->RowID) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <a href="{{ url('admin/news/delete/' . $row->RowID) }}" class="btn btn-danger btn-sm" 
                    onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục tin tức này không?')"><i class="fas fa-trash"></i></a>
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