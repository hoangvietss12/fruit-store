@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Sửa sản phẩm </h3>
    </div>
    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('product.update', ['id' => $data->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm:</label>
                            <input type="text" class="form-control" id="product_name" name="product_name"  placeholder="Tên sản phẩm..." value="{{$data->name}}">
                            @error('product_name')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Danh mục sản phẩm:</label>
                            <select class="js-example-basic-single" name="product_category" style="width:100%">
                                <option value="" disabled>Chọn danh mục sản phẩm</option>
                                @foreach($categories as $category)
                                    @if($data->category_id == $category->id)
                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nhà cung cấp:</label>
                            <select class="js-example-basic-single" name="product_vendor" style="width:100%">
                                <option value="" disabled>Chọn nhà cung cấp</option>
                                @foreach($vendors as $vendor)
                                    @if($data->vendor_id == $vendor->id)
                                        <option value="{{$vendor->id}}" selected>{{$vendor->name}}</option>
                                    @else
                                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_unit">Đơn vị tính:</label>
                            <input type="text" class="form-control" id="product_unit" name="product_unit" placeholder="Đơn vị tính..." value="{{$data->unit}}">
                            @error('product_unit')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">Số lượng:</label>
                            <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="Số lượng..." value="{{$data->quantity}}">
                            @error('product_quantity')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_price">Giá:</label>
                            <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Giá..." value="{{$data->price}}">
                            @error('product_price')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_discount">Giảm giá:</label>
                            <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Giảm giá..." value="{{$data->discount}}">
                            @error('product_discount')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="product_status">Trạng thái:</label>
                            <input type="text" class="form-control" id="product_status" name="product_status" placeholder="Trạng thái..." value="{{$data->status}}">
                        </div>
                        <div class="form-group">
                            <label for="product_description">Mô tả sản phẩm:</label>
                            <textarea class="form-control" id="product_description" rows="4" name="product_description" placeholder="Mô tả về sản phẩm..." value="{{$data->description}}"></textarea>
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

                        <button type="submit" class="btn btn-warning mr-2">Sửa</button>
                    </form>
                    <a class="btn btn-primary mt-3" href="{{ route('product.index') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@stop
