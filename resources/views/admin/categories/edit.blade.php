@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Danh mục sản phẩm </h3>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('category.update', ['id' => $data->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Sửa danh mục sản phẩm:</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Sửa danh mục sản phẩm..." value="{{$data->name}}">
                            @error('category_name')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning mr-2">Sửa</button>
                    </form>
                    <a class="btn btn-primary mt-3" href="{{ route('category.index') }}">Quay lại</a>
                </div>
            </div>
        </div>

    </div>

@stop
