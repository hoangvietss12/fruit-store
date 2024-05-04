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

    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Danh sách sản phẩm </h3>
    </div>

    <div class="form-container mt-3">
        <form action="{{ route('product.search') }}" method="post" class="d-flex align-items-center flex-wrap">
            @csrf
            <div class="form-group" style="width: 250px">
                <label for="vendor_name">Tên sản phẩm:</label>
                <input type="text" class="form-control" name="product_name" placeholder="Nhập từ khóa...">
            </div>
            <div class="form-group ml-2" style="width: 250px">
                <label>Danh mục sản phẩm:</label>
                <select class="js-example-basic-single" name="product_category" style="width:100%">
                    <option value="" selected disable>Chọn danh mục sản phẩm</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ml-2" style="width: 250px">
                <label>Nhà cung cấp:</label>
                <select class="js-example-basic-single" name="product_vendor" style="width:100%">
                    <option value="" selected>Chọn nhà cung cấp</option>
                    @foreach($vendors as $vendor)
                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ml-2" style="width: 200px">
                <label>Đơn giá:</label>
                <select class="js-example-basic-single" name="product_price" style="width:100%">
                    <option value="" selected>Chọn khoảng giá</option>
                    @foreach($range_price as $price)
                            @if($price == '1000001-')
                                 <option value="{{$price}}">
                                    > {{ number_format((float) explode('-', $price)[0]) }}đ
                                </option>
                            @else
                                <option value="{{$price}}">
                                    {{ number_format((float) explode('-', $price)[0]) }}đ - {{ number_format((float) explode('-', $price)[1]) }}đ
                                </option>
                            @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group ml-2" style="width: 150px">
                <label>Giảm giá:</label>
                <select class="js-example-basic-single" name="product_discount" style="width:100%">
                    <option value="" selected> Chọn giảm giá </option>
                    <option value="true"> Có </option>
                    <option value="false"> Không </option>
                </select>
            </div>
            <div class="form-group ml-2" style="width: 200px">
                <label>Trạng thái:</label>
                <select class="js-example-basic-single" name="product_status" style="width:100%">
                    <option value="" selected disable> Chọn trạng thái </option>
                    <option value="Còn hàng"> Còn hàng </option>
                    <option value="Hết hàng"> Hết hàng </option>
                </select>
            </div>
            <button type="submit" class="btn btn-search d-flex ml-2">
                <span class="mdi mdi-magnify mr-1"></span>
                Tìm kiếm
            </button>
        </form>
    </div>

    <div class="d-flex justify-end my-3">
        <a class="btn btn-success d-flex" href="{{route('product.create')}}" role="button">
            <span class="mdi mdi-plus mr-1"></span>
            Thêm
        </a>
    </div>

    @if(!empty($data) && !$data->isEmpty())
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
                                                <a class="btn btn-primary ml-2 d-flex" href="{{route('product.view', ['id' => $item->id])}}" role="button">
                                                    <span class="mdi mdi-eye-outline mr-1"></span>
                                                    Xem chi tiết
                                                </a>
                                                <a class="btn btn-warning ml-2 d-flex" href="{{route('product.edit', ['id' => $item->id])}}" role="button">
                                                    <span class="mdi mdi-pencil mr-1"></span>
                                                    Sửa
                                                </a>
                                                <a class="btn btn-danger ml-2 d-flex" href="{{route('product.delete', ['id' => $item->id])}}" role="button">
                                                    <span class="mdi mdi-delete mr-1"></span>
                                                    Xóa
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
    @else
        <p class="text-notfound">Không có sản phẩm nào</p>
    @endif
@stop
