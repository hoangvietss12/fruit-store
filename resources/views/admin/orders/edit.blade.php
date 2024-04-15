@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Đơn hàng #{{ $data->id }} </h3>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('order.update', ['id' => $data->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Sửa trạng thái:</label>
                            <select class="js-example-basic-single" name="order_type" style="width:100%">
                                @if($data->status == "Chờ xác nhận")
                                    <option value="" disable>Chọn trạng thái</option>
                                    <option value="Chờ xác nhận" selected>Chờ xác nhận</option>
                                    <option value="Đã xác nhận">Đã xác nhận</option>
                                @else
                                    <option value="" disable>Chọn trạng thái</option>
                                    <option value="Chờ xác nhận">Chờ xác nhận</option>
                                    <option value="Đã xác nhận" selected>Đã xác nhận</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning mr-2">Sửa</button>
                    </form>
                    <a class="btn btn-primary mt-3" href="{{ route('order.index') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@stop
