<!DOCTYPE html>
<html lang="vn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Hóa đơn #{{ $order_info->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: 'Arial Unicode MS', Arial, sans-serif;
        }

        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: 'Arial Unicode MS', Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: 'Arial Unicode MS', Arial, sans-serif;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: 'Arial Unicode MS', Arial, sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: 'Arial Unicode MS', Arial, sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: 'Arial Unicode MS', Arial, sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: 'Arial Unicode MS', Arial, sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Cửa hàng trái cây Fruit-ya</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Mã hóa đơn: #{{ $order_info->id }}</span> <br>
                    <span>Ngày: {{ date("d/m/Y", strtotime($order_info->updated_at)) }}</span> <br>
                    <span>Mã bưu chính: 100000</span> <br>
                    <span>Địa chỉ: 9A28 Hoàng Quốc Việt, Nghĩa Tân, Cầu Giấy, Hà Nội</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Thông tin hóa đơn</th>
                <th width="50%" colspan="2">Thông tin khách hàng</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Mã hóa đơn:</td>
                <td>{{ $order_info->id }}</td>

                <td>Tên khách hàng:</td>
                <td>{{ $order_info->user->name }}</td>
            </tr>
            <tr>
                <td>Ngày đặt hàng:</td>
                <td>{{ date("d/m/Y H:i", strtotime($order_info->created_at)) }}</td>

                <td>Email:</td>
                <td>{{ $order_info->user->email }}</td>
            </tr>
            <tr>
                <td>Phương thức đặt hàng: </td>
                <td>{{ $order_info->order_type }}</td>

                <td>Số điện thoại:</td>
                <td>{{ $order_info->user->phone }}</td>
            </tr>
            <tr>
                <td>Trạng thái:</td>
                <td>{{ $order_info->status }}</td>

                <td>Địa chỉ:</td>
                <td>{{ $order_info->user->address }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Sản phẩm
                </th>
            </tr>
            <tr class="bg-blue">
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Đơn vị tính</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_detail_info as $index => $item)
            <tr>
                <td width="10%">{{ $index+1 }}</td>
                <td>
                    {{ $item->product->name }}
                </td>
                <td width="15%">{{ number_format($item->price) }}đ</td>
                <td width="10%">{{ $item->quantity }}</td>
                <td width="10%">{{ $item->product->unit }}</td>
                <td width="15%" class="fw-bold">{{ number_format($item->total_price) }}đ</td>
            </tr>
            @endforeach

            <tr>
                @if($order_info->order_type == "Ship tận nơi")
                    <tr>
                        <td colspan="5" class="total-heading">Phí vận chuyển:</td>
                        <td colspan="1" class="total-heading">15,000đ</td>
                    </tr>
                @endif
                <tr>
                    <td colspan="5" class="total-heading">Tổng tiền:</td>
                    <td colspan="1" class="total-heading">{{ number_format($order_info->total) }}đ</td>
                </tr>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Cảm ơn quý khách đã mua hàng tại cửa hàng trái cây Fruit-ya!
    </p>

</body>
</html>
