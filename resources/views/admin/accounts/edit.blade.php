@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Tài khoản #{{ $data->id }} </h3>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('account.update', ['id' => $data->id]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Sửa trạng thái:</label>
                            <select class="js-example-basic-single" name="account_status" style="width:100%">
                                @if($data->status == "active")
                                    <option value="" disable>Chọn trạng thái</option>
                                    <option value="active" selected>Hoạt động</option>
                                    <option value="deactive">Bị khóa</option>
                                @else
                                    <option value="" disable>Chọn trạng thái</option>
                                    <option value="active">Hoạt động</option>
                                    <option value="deactive" selected>Bị khóa</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning mr-2">Sửa</button>
                    </form>
                    <a class="btn btn-primary mt-3" href="{{ route('account.index') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@stop
