@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Thêm sản phẩm </h3>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Tên sản phẩm..." value="{{ old('product_name') }}">
                            @error('product_name')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Danh mục sản phẩm:</label>
                            <select class="js-example-basic-single" name="product_category" style="width:100%">
                                <option value="" selected disabled>Chọn danh mục sản phẩm</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('product_category')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Nhà cung cấp:</label>
                            <select class="js-example-basic-single" name="product_vendor" style="width:100%">
                                <option value="" selected disabled>Chọn nhà cung cấp</option>
                                @foreach($vendors as $vendor)
                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                @endforeach
                            </select>
                            @error('product_vendor')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_unit">Đơn vị tính:</label>
                            <input type="text" class="form-control" id="product_unit" name="product_unit" placeholder="Đơn vị tính..." value="{{ old('product_unit') }}">
                            @error('product_unit')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">Số lượng:</label>
                            <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="Số lượng..." value="{{ old('product_quantity') }}">
                            @error('product_quantity')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_price">Giá:</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Giá..." value="{{ old('product_price') }}">
                            @error('product_price')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_discount">Giảm giá:</label>
                            <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Giảm giá..." value="{{ old('product_discount') }}">
                            @error('product_discount')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_description">Mô tả sản phẩm:</label>
                            <textarea class="form-control" id="product_description" id="summernote" name="product_description" placeholder="Mô tả về sản phẩm..." value="{{ old('product_description') }}"></textarea>
                            @error('product_description')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_images">Ảnh sản phẩm: </label>
                            <div class="input-group col-xs-12">
                                <input type="file" name="product_images[]" id="product_images" multiple="multiple">
                            </div>
                            @error('product_images')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success mr-2">Thêm</button>
                    </form>
                    <a class="btn btn-primary mt-3" href="{{ route('product.index') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
<!-- Tải Summernote từ CDN -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>

@stop
