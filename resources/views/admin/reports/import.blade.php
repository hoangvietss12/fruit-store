@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h1 class="page-title"> Báo cáo nhập hàng </h1>
    </div>

    <div class="form-container my-3">
        <form id="form-report" action="{{route('report.import.search')}}" method="post" class="d-flex justify-content-between flex-row flex-wrap">
            @csrf
            <div class="form-group form-search-category">
                <label>Danh mục sản phẩm:</label>
                <select class="js-example-basic-single" name="product_category" style="width:100%">
                    <option value="" selected>Chọn danh mục sản phẩm</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group form-search-vendor">
                <label>Nhà cung cấp:</label>
                <select class="js-example-basic-single" name="product_vendor" style="width:100%">
                    <option value="" selected>Chọn nhà cung cấp</option>
                    @foreach($vendors as $vendor)
                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ml-2" style="width: 200px">
                <label>Ngày bắt đầu:</label>
                <input type="date" class="form-control" name="date_start">
            </div>
            <div class="form-group ml-2" style="width: 200px">
                <label>Ngày kết thúc:</label>
                <input type="date" class="form-control" name="date_end">
            </div>
        </form>
        <button class="btn btn-success mr-2 d-block text-center" id="btn-report-search">
            <span class="mdi mdi-magnify-plus mr-1"></span>
            Tạo báo cáo
        </button>
    </div>

    <div id="searchResults">
        @if(!empty($data) && !$data->isEmpty())
            <div class="d-flex justify-end my-3">
                <a class="btn btn-success d-flex"
                    href="{{route('report.import.export',
                    [
                        'categoryId' => $params['category'],
                        'vendorId' => $params['vendor'],
                        'start' => $params['start'],
                        'end' => $params['end']
                    ])}}">

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
                                            <th> Số lượng đã nhập </th>
                                            <th> Tổng tiền </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                        <tr>
                                            <td>{{$index+1}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->category->name}}</td>
                                            <td>{{$item->vendor->name}}</td>
                                            <td>{{$item->goodsReceivedNoteDetails->sum('quantity')}} {{$item->unit}}</td>
                                            <td>{{number_format($item->goodsReceivedNoteDetails->sum('total_price'))}}đ</td>
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
            <p class="text-notfound text-black">Không có báo cáo nào</p>
        @endif
    </div>
@stop


