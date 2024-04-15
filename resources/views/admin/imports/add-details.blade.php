@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Thêm chi tiết phiếu nhập hàng </h3>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('import.store.product', ['id' => $goods_received_note->id])}}" method="post" id="product-container">
                        @csrf
                        <div class="product-group">
                            <div class="form-group">
                                <label>Chọn sản phẩm:</label>
                                <select class="js-example-basic-single" name="product[]" style="width:100%">
                                    <option value="" selected disabled>Chọn sản phẩm</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                                @error('product')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_quantity">Số lượng:</label>
                                <input type="text" class="form-control" id="quantity" name="quantity[]" placeholder="Số lượng..." value="{{ old('quantity') }}">
                                @error('quantity')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="product_quantity">Đơn giá:</label>
                                <input type="text" class="form-control" id="price" name="price[]" placeholder="Đơn giá..." value="{{ old('price') }}">
                                @error('price')
                                    <p class="text-danger mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="note">Ghi chú:</label>
                                <textarea class="form-control" id="note" rows="3" name="note[]" placeholder="Ghi chú..." value="{{ old('price') }}"></textarea>
                            </div>
                        </div>
                        <button class="btn btn-success mr-2" id="btn-add-more">Thêm tiếp</button>
                        <button type="submit" class="btn btn-primary mr-2">Hoàn thành</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
