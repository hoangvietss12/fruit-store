@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h1 class="page-title"> Thống kê sản phẩm </h1>
    </div>

    <div class="form-container my-3">
        <form id="form-report" action="{{route('report.product.search')}}" method="post" class="d-flex justify-content-between flex-row flex-wrap">
            @csrf
            <div class="form-group form-search-category">
                <label>Danh mục sản phẩm:</label>
                <select class="js-example-basic-single" name="product_category" style="width:100%">
                    <option value="" selected>Chọn danh mục sản phẩm</option>
                    @foreach($categories as $category)
                        @if(!empty($params) && $params['category'] == $category->id)
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group form-search-vendor">
                <label>Nhà cung cấp:</label>
                <select class="js-example-basic-single" name="product_vendor" style="width:100%">
                    <option value="" selected>Chọn nhà cung cấp</option>
                    @foreach($vendors as $vendor)
                        @if(!empty($params) && $params['vendor'] == $vendor->id)
                            <option value="{{$vendor->id}}" selected>{{$vendor->name}}</option>
                        @else
                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group form-search-price">
                <label>Đơn giá:</label>
                <select class="js-example-basic-single" name="product_price" style="width:100%">
                    <option value="" selected>Chọn khoảng giá</option>
                    @foreach($range_price as $price)
                        @if(!empty($params) && $params['price'] == $price)
                            <option value="{{$price}}" selected>
                                {{ number_format((float) explode('-', $price)[0]) }}đ - {{ number_format((float) explode('-', $price)[1]) }}đ
                            </option>
                        @else
                            @if($price == '1000001-')
                                <option value="{{$price}}">
                                    > {{ number_format((float) explode('-', $price)[0]) }}đ
                                </option>
                            @else
                                <option value="{{$price}}">
                                    {{ number_format((float) explode('-', $price)[0]) }}đ - {{ number_format((float) explode('-', $price)[1]) }}đ
                                </option>
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group form-search-discount">
                <label>Giảm giá:</label>
                <select class="js-example-basic-single" name="product_discount" style="width:100%">
                        @if(!empty($params) && $params['discount'] == 'true')
                            <option value="true" selected> Có </option>
                            <option value="false"> Không </option>
                        @else
                            <option value="true"> Có </option>
                            <option value="false" selected> Không </option>
                        @endif
                </select>
            </div>
        </form>
        <button class="btn btn-success mr-2 d-block text-center" id="btn-report-search">
            <span class="mdi mdi-magnify-plus mr-1"></span>
            Tạo thống kê
        </button>
    </div>

    <div id="searchResults">
        @if(!empty($data) && !$data->isEmpty())
            <div class="d-flex justify-end my-3">
                <a class="btn btn-success d-flex"
                    href="{{route('report.product.export',
                    [
                        'categoryId' => $params['category'],
                        'vendorId' => !$params['vendor'],
                        'price' => $params['price']
                    ])}}"
                    role="button"
                >
                    <span class="mdi mdi-export-variant mr-1"></span>
                    Xuất file
                </a>
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
                                            <th> Danh mục sản phẩm </th>
                                            <th> Nhà cung cấp </th>
                                            <th> Số lượng </th>
                                            <th> Đơn giá </th>
                                            @if($is_discount == 'true')
                                                <th> Giảm giá </th>
                                            @endif
                                            <th> Tình trạng </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->category->name}}</td>
                                            <td>{{$item->vendor->name}}</td>
                                            <td>{{$item->quantity}} {{$item->unit}}</td>
                                            <td>{{number_format($item->price)}}đ</td>
                                            @if($is_discount == 'true')
                                                <th> {{$item->discount}} </th>
                                            @endif
                                            <td>{{$item->status}}</td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-notfound">Không có sản phẩm nào</p>
        @endif
    </div>
@stop


