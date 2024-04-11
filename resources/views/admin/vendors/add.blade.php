@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Thêm nhà cung cấp </h3>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('vendor.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tên nhà cung cấp:</label>
                            <input type="text" class="form-control" name="vendor_name" placeholder="Tên nhà cung cấp...">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" class="form-control" name="vendor_email" placeholder="Email...">
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại:</label>
                            <input type="text" class="form-control" name="vendor_phone" placeholder="Số điện thoại...">
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ:</label>
                            <input type="text" class="form-control" name="vendor_address" placeholder="Địa chỉ...">
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Thêm</button>
                    </form>
                    <a class="btn btn-primary mt-3" href="{{ route('vendor.index') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@stop
