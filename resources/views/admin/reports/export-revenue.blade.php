@if(isset($data))
<h2>Báo cáo doanh thu từ {{ date('d/m/Y', strtotime($start)) }} đến {{ date('d/m/Y', strtotime($end)) }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> STT </th>
                <th> Ngày/tháng/năm </th>
                <th> Số tiền nhập hàng </th>
                <th> Số tiền bán hàng </th>
                <th> Số tiền lỗ/lãi </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ date('d/m/Y', strtotime($item['date'])) }}</td>
                    <td>{{ number_format($item['total_import_price']) }}đ</td>
                    <td>{{ number_format($item['total_sale_price']) }}đ</td>
                    <td>{{ number_format($item['total_sale_price'] - $item['total_import_price']) }}đ</td>
                </tr>
            @endforeach

        </tbody>
    </table>

@endif
