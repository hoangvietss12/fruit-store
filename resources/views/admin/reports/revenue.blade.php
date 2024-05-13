@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h1 class="page-title"> Báo cáo doanh thu </h1>
    </div>

    <div class="form-container my-3">
        <form id="form-report" action="{{route('report.revenue.search')}}" method="post" class="d-flex flex-row flex-wrap">
            @csrf
            <div class="form-group" style="width: 250px">
                <label>Ngày bắt đầu:</label>
                <input type="date" class="form-control" name="date_start">
            </div>
            <div class="form-group ml-3" style="width: 250px">
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
                    href="{{route('report.revenue.export',
                    [
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
                                            <th> Ngày/tháng/năm </th>
                                            <th> Số tiền nhập hàng </th>
                                            <th> Số tiền bán hàng </th>
                                            <th> Số tiền lỗ/lãi </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $index => $item)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ date('d/m/Y', strtotime($item['date'])) }}</td>
                                            <td>{{ number_format($item['total_import_price']) }}đ</td>
                                            <td>{{ number_format($item['total_sale_price']) }}đ</td>
                                            <td>{{ number_format($item['total_sale_price'] - $item['total_import_price']) }}đ</td>
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
            <p class="text-notfound">Không có báo cáo nào</p>
        @endif
    </div>
@stop


