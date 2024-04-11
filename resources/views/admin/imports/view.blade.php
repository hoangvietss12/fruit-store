<!DOCTYPE html>
<html lang="vn">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Phiếu nhập hàng #{{ $note_info->id }}</title>

    <style>
    html,
    body {
        margin: 10px;
        padding: 10px;
        font-family: 'Arial Unicode MS', Arial, sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    span,
    label {
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

    table,
    th,
    td {
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
    <div class="note-header">
        <h1 class="text-center">Phiếu nhập hàng</h1>
    </div>

    <div class="note-infor text-end">
        <p>Mã phiếu nhập hàng: #{{ $note_info->id }}</p>
        <p>Ngày nhập hàng: {{ date("d/m/Y", strtotime($note_info->created_at)) }}</p>
        <p>Mã bưu chính: 100000</p>
        <p>Địa điểm: 9A28 Hoàng Quốc Việt, Nghĩa Tân, Cầu Giấy, Hà Nội</p>
    </div>

    <div>
        <h3>Thông tin nhà cung cấp</h3>
        <p>Tên nhà cung cấp: {{ $note_info->vendor->name }}</p>
        <p>Email: {{ $note_info->vendor->email }}</p>
        <p>Số điện thoại: {{ $note_info->vendor->phone }}</p>
        <p>Địa chỉ: {{ $note_info->vendor->address }}</p>
    </div>

    <hr>

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
            @foreach($note_detail_info as $index => $item)
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
            <tr>
                <td colspan="5" class="total-heading">Tổng tiền:</td>
                <td colspan="1" class="total-heading">{{ number_format($note_info->total) }}đ</td>
            </tr>
            </tr>
        </tbody>
    </table>
</body>

</html>
