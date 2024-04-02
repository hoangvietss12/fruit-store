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

    <div class="page-header">
        <h3 class="page-title"> Danh sách sản phẩm </h3>
    </div>

    <div class="d-flex justify-end my-3">
        <a class="btn btn-success" href="{{route('product.create')}}" role="button">Thêm</a>
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
                                    <th> Tên sản phẩm </th>
                                    <th> Ảnh </th>
                                    <th> Hành động </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td class="table-images">
                                        @foreach($item->images as $imageUrl)
                                        <img src={{$imageUrl}} alt="">
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex justify-center">
                                            <a class="btn btn-primary ml-2"
                                                href="{{route('product.view', ['id' => $item->id])}}" role="button">Xem</a>
                                            <a class="btn btn-warning ml-2"
                                                href="{{route('product.edit', ['id' => $item->id])}}" role="button">Sửa</a>
                                            <a class="btn btn-danger ml-2"
                                                href="{{route('product.delete', ['id' => $item->id])}}"
                                                role="button">Xóa</a>
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
