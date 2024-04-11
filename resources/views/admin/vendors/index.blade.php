@extends('layouts.admin')

@section('content')
    @if(session('message') == 'Thêm thành công!')
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{session('message')}}
        </div>
    @elseif(session('message') == 'Xóa thành công!')
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{session('message')}}
        </div>
    @elseif(session('message') == 'Cập nhật thành công!')
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{session('message')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Danh sách nhà cung cấp</h3>
    </div>

    <div class="d-flex justify-end my-3">
        <a class="btn btn-success d-flex" href="{{route('vendor.create')}}" role="button">
            <span class="mdi mdi-plus mr-1"></span>
            Thêm
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Tên nhà cung cấp </th>
                                    <th> Email </th>
                                    <th> Số điện thoại</th>
                                    <th> Địa chỉ </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>
                                        <div class="d-flex justify-center">
                                            <a class="btn btn-warning ml-2 d-flex" href="{{route('vendor.edit', ['id' => $item->id])}}" role="button">
                                                <span class="mdi mdi-pencil mr-1"></span>
                                                Sửa
                                            </a>
                                            <a class="btn btn-danger ml-2 d-flex" href="{{route('vendor.delete', ['id' => $item->id])}}" role="button">
                                                <span class="mdi mdi-delete mr-1"></span>
                                                Xóa
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ $data->links() }}
@stop
