@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h3 class="page-title"> Sửa sản phẩm </h3>
    </div>
    <div class="row">

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('product.update', ['id' => $data->id])}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="product_name">Tên sản phẩm:</label>
                            <input type="text" class="form-control" id="product_name" name="name"
                                placeholder="Tên sản phẩm..." value="{{$data->name}}">
                        </div>
                        <div class="form-group">
                            <label>Danh mục sản phẩm:</label>
                            <select class="js-example-basic-single" name="category" style="width:100%">
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
                            <select class="js-example-basic-single" name="vendor" style="width:100%">
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
                            <input type="text" class="form-control" id="product_unit" name="unit"
                                placeholder="Đơn vị tính..." value="{{$data->unit}}">
                        </div>
                        <div class="form-group">
                            <label for="product_quantity">Số lượng:</label>
                            <input type="text" class="form-control" id="product_quantity" name="quantity"
                                placeholder="Số lượng..." value="{{$data->quantity}}">
                        </div>
                        <div class="form-group">
                            <label for="product_price">Giá:</label>
                            <input type="text" class="form-control" id="product_price" name="price" placeholder="Giá..."
                                value="{{$data->price}}">
                        </div>
                        <div class="form-group">
                            <label for="product_discount">Giảm giá:</label>
                            <input type="text" class="form-control" id="product_discount" name="discount"
                                placeholder="Giảm giá..." value="{{$data->discount}}">
                        </div>
                        <div class="form-group">
                            <label for="product_status">Trạng thái:</label>
                            <input type="text" class="form-control" id="product_status" name="status"
                                placeholder="Trạng thái..." value="{{$data->status}}">
                        </div>
                        <div class="form-group">
                            <label for="product_description">Mô tả sản phẩm:</label>
                            <textarea class="form-control" id="product_description" rows="4" name="description"
                                placeholder="Mô tả về sản phẩm..." value="{{$data->description}}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="product_images">Ảnh sản phẩm: </label>
                            <div class="input-group col-xs-12">
                                <input type="file" name="images[]" id="product_images" multiple="multiple">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-warning mr-2">Sửa</button>
                    </form>
                    <a class="btn btn-primary mt-3" href="{{ route('product.index') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@stop
