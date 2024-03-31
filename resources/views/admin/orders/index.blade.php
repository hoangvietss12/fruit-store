<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Fruit-ya Admin</title>
    {{-- style css --}}
    @include('admin.assets.css')

    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.components.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.components.navbar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
              @if(session('message') == 'Cập nhật thành công!')
                <div class="alert alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

                    {{session('message')}}
                </div>
              @endif

              <div class="page-header">
                <h3 class="page-title"> Danh sách đơn hàng</h3>
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
                              <th> Tên khách hàng </th>
                              <th> Ngày đặt hàng </th>
                              <th> Trạng thái </th>
                              <th> Thành tiển </th>
                              <th> Hành động </th>
                            </tr>
                          </thead>
                          <tbody>

                            @foreach($data as $index => $item)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{date("H:i:s d/m/Y", strtotime($item->created_at))}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{{number_format($item->total)}}đ</td>
                                    <td>
                                        <div class="d-flex justify-center">
                                            <a class="btn btn-primary ml-2" target="_blank" href="{{route('order.view', ['id' => $item->id])}}" role="button">Xem chi tiết</a>
                                            <a class="btn btn-warning ml-2" href="{{route('order.edit', ['id' => $item->id])}}" role="button">Sửa trạng thái</a>
                                            <a class="btn btn-success ml-2" target="_blank" href="{{route('order.print', ['id' => $item->id])}}" role="button">In hóa đơn</a>
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
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            @include('admin.components.footer')
            <!-- partial -->
          </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    {{-- js --}}
    @include('admin.assets.js')

  </body>
</html>
