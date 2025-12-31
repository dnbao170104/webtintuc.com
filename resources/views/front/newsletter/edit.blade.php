@extends('back.template.master')

@section('title', 'Quản lý khuyến mãi')
@section('heading', 'Chỉnh sửa khuyến mãi')
@section('newsletter','active')

@section('content')
<div class="container-fluid p-4">
    <h1 class="mb-4" ><b>Chỉnh sửa thông tin khuyến mãi</b></h1>
 <div class="card-footer">
            <a href="{{ url('admin/newsletter/list') }} "><button type="submit" class="btn btn-primary">Quay lại</button></a>
        </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <form action="{{ url('admin/newsletter/edit/' . $Newsletter->RowID) }}" method="POST">
                    <input type="hidden" name="id" >
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="Status" id="Status">
                                <option value="1" @if ($Newsletter->IsViews == 1) selected @endif>Đã xem</option>
                                <option value="0" @if ($Newsletter->IsViews == 0) selected @endif>Chưa xem</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Email">Email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="Email" name="Email" value="{{ $Newsletter->Email }}"
                                   placeholder="Email">
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
