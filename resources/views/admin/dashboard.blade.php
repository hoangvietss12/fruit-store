@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-xl-4 mb-3">
                <div class="card flex-row bg-primary">
                    <div class="card-header d-flex flex-column justify-content-center align-items-center">
                        <div class="card-title-icon">
                            <span class="mdi mdi-account-box"></span>
                        </div>
                        <h2 class="card-title">
                            Tài khoản
                        </h2>
                    </div>

                    <div class="card-body">
                        <p class="card-content mb-1">Tổng số tài khoản: {{ $data['account_total'] }}</p>
                        <p class="card-content mb-1">Tài khoản hoạt động: {{ $data['account_active'] }}</p>
                        <p class="card-content">Tài khoản bị khóa: {{ $data['account_deactive'] }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 mb-3">
                <div class="card flex-row bg-success">
                    <div class="card-header d-flex flex-column justify-content-center align-items-center">
                        <div class="card-title-icon">
                            <i class="mdi mdi-table-large"></i>
                        </div>
                        <h2 class="card-title">
                            Sản phẩm
                        </h2>
                    </div>

                    <div class="card-body">
                        <p class="card-content mb-1">Tổng số sản phẩm: {{ $data['product_total'] }}</p>
                        <p class="card-content mb-1">Sản phẩm hiện bán: {{ $data['product_active'] }}</p>
                        <p class="card-content">Sản phẩm tạm hết hàng: {{ $data['product_deactive'] }}</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 mb-3">
                <div class="card flex-row bg-danger">
                    <div class="card-header d-flex flex-column justify-content-center align-items-center">
                        <div class="card-title-icon">
                            <i class="mdi mdi-file-document-box"></i>
                        </div>
                        <h2 class="card-title">
                            Đơn hàng
                        </h2>
                    </div>

                    <div class="card-body">
                        <p class="card-content mb-1">Tổng số đơn hàng: {{ $data['order_total'] }}</p>
                        <p class="card-content mb-1">Đơn hàng đã xác nhận: {{ $data['order_active'] }}</p>
                        <p class="card-content">Đơn hàng chưa xác nhận: {{ $data['order_deactive'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="revenue-chart" class="mt-5 border border-dark" style="width:100%; height:400px;"></div>
        <div id="order-chart" class="mt-5 border border-dark" style="width:100%; height:400px;"></div>
        <div id="goods-received-note-chart" class="mt-5 border border-dark" style="width:100%; height:400px;"></div>
    </div>

@stop

@section('script')
    <script>
        // revenue chart
        const revenueData = {!! json_encode($revenue_data) !!};

        revenueData.forEach(item => {
            let dateParts = item['date'].split('-');
            item['date'] = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
        });

        const formattedRevenueData = revenueData.map(item => {
            const profit = item['total_sale_price'] - item['total_import_price'];
            return profit > 0 ? profit : 0;
        });

        Highcharts.chart('revenue-chart', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Lợi nhuận trong 7 ngày qua'
            },
            xAxis: {
                categories: revenueData.map(item => item['date'])
            },
            yAxis: {
                title: {
                    text: 'Số tiền (VND)'
                },
                floor: 0,
                allowDecimals: false
            },
            series: [{
                    name: 'Lợi nhuận',
                    data: formattedRevenueData
                },
                {
                    name: 'Số tiền nhập hàng',
                    data: revenueData.map(item => item['total_import_price'])
                },
                {
                    name: 'Số tiền bán hàng',
                    data: revenueData.map(item => item['total_sale_price'])
                }
            ],
            tooltip: {
                pointFormatter: function() {
                    return `<span style="color:${this.color}">\u25CF</span> ${this.series.name}: <b>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(this.y)}</b><br/>`;
                }
            }
        });

        // order chart
        const orderData = {!! json_encode($order_data) !!};

        orderData.forEach(item => {
            let dateParts = item.order_date.split('-');
            item.order_date = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
        });

        Highcharts.chart('order-chart', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Số đơn hàng trong 7 ngày qua'
            },
            xAxis: {
                categories: orderData.map(item => item.order_date)
            },
            yAxis: {
                title: {
                    text: 'Số lượng đơn hàng'
                },
                floor: 0,
                allowDecimals: false
            },
            series: [{
                name: 'Đơn hàng',
                data: orderData.map(item => item.total_orders)
            }]
        });

        // goods received note chart
        const goodsReceivedNoteData = {!! json_encode($goods_received_note_data) !!};

        goodsReceivedNoteData.forEach(item => {
            let dateParts = item.date.split('-');
            item.date = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
        });

        Highcharts.chart('goods-received-note-chart', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Số lần nhập hàng trong 7 ngày qua'
            },
            xAxis: {
                categories: goodsReceivedNoteData.map(item => item.date)
            },
            yAxis: {
                title: {
                    text: 'Số phiếu nhập hàng'
                },
                floor: 0,
                allowDecimals: false
            },
            series: [{
                name: 'Phiếu nhập hàng',
                data: goodsReceivedNoteData.map(item => item.total)
            }]
        });
    </script>
@stop
