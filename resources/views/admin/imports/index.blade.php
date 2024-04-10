@extends('layouts.admin')

@section('content')
    @if(session('message') == 'Thêm thành công!')
    <div class="alert alert-success">
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
        <h3 class="page-title">Danh sách nhập hàng</h3>
    </div>

    <div class="d-flex justify-end my-3">
        <a class="btn btn-success d-flex" href="{{route('import.create')}}" role="button">
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
                                    <th> Ngày nhập hàng </th>
                                    <th> Thành tiển </th>
                                    <th> Hành động </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->vendor->name}}</td>
                                    <td>{{date("d/m/Y", strtotime($item->created_at))}}</td>
                                    <td>{{number_format($item->total)}}đ</td>
                                    <td>
                                        <div class="d-flex justify-center">
                                            <a class="btn btn-primary ml-2 d-flex" target="_blank" href="{{route('import.view', ['id' => $item->id])}}" role="button">
                                                <span class="mdi mdi-eye-outline mr-1"></span>
                                                Xem chi tiết
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
