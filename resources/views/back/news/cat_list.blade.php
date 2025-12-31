@extends('back.template.master')

@section('title', 'Quan lý danh mục tin tức')
@section('heading', 'Danh sách danh mục tin tức')
@section('news','active')

@section('content')

    <h1 class="mb-4">Quản lý danh mục tin tức</h1>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Danh sách danh mục tin tức</b></h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
    <tr>
        <th style="width: 10px">STT</th>
        <th>Tên danh mục</th>
        <th>Trạng thái</th>
        <th><i class="fas fa-wrench"></i></th>
    </tr>
</thead>

<tbody>

    @if (isset($NewsCategory) && count($NewsCategory) > 0)
        
        
        @foreach($NewsCategory as $key => $row)
        <tr>
           <td>{{ $key + 1 }}</td>
            <td>{{ $row ->Name}}</td>

            
            <td>@if ($row->Status==1)
                <span class="badge badge-success">Kích hoạt</span>
            @else
                <span class="badge badge-danger">Khóa</span>
                
            @endif</td>
            <td>
                <a href="{{ url('admin/news_cat/cat_edit/' . $row->RowID) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <a href="{{ url('admin/news_cat/delete/' . $row->RowID) }}" class="btn btn-danger btn-sm" 
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