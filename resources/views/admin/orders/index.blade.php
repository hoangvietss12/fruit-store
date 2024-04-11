@extends('layouts.admin')

@section('content')
    @if(session('message') == 'Cập nhật thành công!')
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
        <h3 class="page-title"> Danh sách đơn hàng</h3>
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
                                    <th> Tên khách hàng </th>
                                    <th> Ngày đặt hàng </th>
                                    <th> Trạng thái </th>
                                    <th> Thành tiển </th>
                                    <th> Hành động </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{date("H:i:s d/m/Y", strtotime($item->created_at))}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{{number_format($item->total)}}đ</td>
                                    <td>
                                        <div class="d-flex justify-center">
                                            <a class="btn btn-primary ml-2 d-flex" target="_blank" href="{{route('order.view', ['id' => $item->id])}}" role="button">
                                                <span class="mdi mdi-eye-outline mr-1"></span>
                                                Xem chi tiết
                                            </a>
                                            <a class="btn btn-warning ml-2 d-flex" href="{{route('order.edit', ['id' => $item->id])}}" role="button">
                                                <span class="mdi mdi-pencil mr-1"></span>
                                                Sửa trạng thái
                                            </a>
                                            <a class="btn btn-success ml-2 d-flex" target="_blank" href="{{route('order.print', ['id' => $item->id])}}" role="button">
                                                <span class="mdi mdi-printer-pos mr-1"></span>
                                                In hóa đơn
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
