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
        <h3 class="page-title"> Danh mục sản phẩm </h3>
    </div>

    <div class="d-flex justify-end my-3">
        <a class="btn btn-success" href="{{route('category.create')}}" role="button">Thêm</a>
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
                                    <th> Tên danh mục </th>
                                    <th> Hành động </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        <div class="d-flex justify-center">
                                            <a class="btn btn-warning ml-2"
                                                href="{{route('category.edit', ['id' => $item->id])}}" role="button">Sửa</a>
                                            <a class="btn btn-danger ml-2"
                                                href="{{route('category.delete', ['id' => $item->id])}}"
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
@stop
