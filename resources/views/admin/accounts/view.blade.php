@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h2 class="page-title">Thông tin tài khoản <h2>
    </div>

    <div class="page-content">
        <p>Tên tài khoản: <span>{{ $data->name }}</span></p>
        <p>Email: <span>{{ $data->email }}</span></p>
        <p>Số điện thoại: <span>{{ $data->phone }}</span></p>
        <p>Địa chỉ: <span>{{ $data->address }}</span></p>
        <p>Trạng thái: <span>{{ $data->status }}</span></p>
        <p>Ảnh đại diện:</p>
        <div class="page-images">
            <img src="{{$data->profile_photo_path}}" alt="{{ $data->name }}">
        </div>
    </div>

    <a class="btn btn-primary mt-3" href="{{ route('account.index') }}">Quay lại</a>
@stop
