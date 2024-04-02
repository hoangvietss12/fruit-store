@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h2 class="page-title">{{ $product->name }}</h2>
    </div>

    <div class="page-content">
        <p>Danh mục sản phẩm: <span>{{ $product->category->name }}</span></p>
        <p>Nhà cung cấp: <span>{{ $product->vendor->name }}</span></p>
        <p>Số lượng: <span>{{ $product->quantity }}{{ $product->unit }}</span></p>
        <p>Đơn giá: <span>{{ number_format($product->price) }}đ</span></p>
        <p>Giảm giá: <span>{{ $product->discount }}</span></p>
        <p>Trạng thái: <span>{{ $product->status }}</span></p>
        <p>Ảnh sản phẩm:</p>
        <div class="page-images">
            @foreach($product->images as $imageUrl)
            <img src={{$imageUrl}} alt="{{ $product->name }}">
            @endforeach
        </div>
        <p>Mô tả sản phẩm:</p>
        <p><span>{{ $product->description }}</span></p>
    </div>

    <a class="btn btn-primary mt-3" href="{{ route('product.index') }}">Quay lại</a>
@stop
