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
                    <form action="{{route('category.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Thêm danh mục sản phẩm:</label>
                            <input type="text" class="form-control" name="category_name" placeholder="Thêm danh mục sản phẩm..." value="{{ old('category_name') }}">
                            @error('category_name')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Thêm</button>
                    </form>
                    <a class="btn btn-primary mt-3" href="{{ route('category.index') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@stop
