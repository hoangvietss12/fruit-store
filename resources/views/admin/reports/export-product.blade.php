@if(isset($data))
    <h2>Thống kê sản phẩm từ {{ date('d/m/Y', strtotime($start)) }} đến {{ date('d/m/Y', strtotime($end)) }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th> STT </th>
                <th> Tên sản phẩm </th>
                <th> Danh mục sản phẩm </th>
                <th> Nhà cung cấp </th>
                <th> Số lượng đã nhập </th>
                <th> Số lượng đã bán </th>
                <th> Số lượng còn lại </th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $item)
                <tr>
                    <td>{{$index + 1}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->vendor->name}}</td>
                    <td>{{$item->goodsReceivedNoteDetails->sum('quantity')}} {{$item->unit}}</td>
                    <td>{{$item->orderDetails->sum('quantity')}} {{$item->unit}}</td>
                    <td>{{$item->quantity}} {{$item->unit}}</td>
                </tr>
            @endforeach

        </tbody>
    </table>

@endif
