@extends('back.template.master')

@section('title', 'Quan lý slider')
@section('heading', 'Danh sách slider')
@section('slider','active')

@section('content')

    <h1 class="mb-4">Quản lý slider</h1>
    <div class="card-footer">
            <a href="{{ url('admin/slider/add') }} "><button type="submit" class="btn btn-primary">Thêm slider</button></a>
        </div>
        </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>Danh sách danh mục slider</b></h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
    <tr>
        <th style="width: 10px">STT</th>
        <th>Tên slider</th>
        <th>Ảnh đại diện</th>
        <th><i class="fas fa-wrench"></i></th>
    </tr>
</thead>

<tbody>

    @if (isset($Slider) && count($Slider) > 0)
        
        
        @foreach($Slider as $key => $row)
        <tr>
           <td>{{ $key + 1 }}</td>
            <td>{{ $row ->Name}}</td>
            <td>
                @if($row->Images!=null)
                <img src="{{ asset('images/news_slider/' . $row->Images) }}" alt="Ảnh slider" width="100" />
                @endif
            
            <td>@if ($row->Status==1)
                <span class="badge badge-success">Kích hoạt</span>
            @else
                <span class="badge badge-danger">Khóa</span>
                
            @endif</td>
            <td>
                <a href="{{ url('admin/slider/edit/' . $row->RowID) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <a href="{{ url('admin/slider/delete/' . $row->RowID) }}" class="btn btn-danger btn-sm" 
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