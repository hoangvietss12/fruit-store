@if(isset($data))

    <table class="table table-bordered">
        <thead>
            <tr>
                <th> STT </th>
                <th> Tên sản phẩm </th>
                <th> Danh mục sản phẩm </th>
                <th> Nhà cung cấp </th>
                <th> Số lượng </th>
                <th> Đơn giá </th>
                <th> Giảm giá </th>
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
                <th> {{$item->discount}} </th>
                <td>{{$item->status}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>

@endif
