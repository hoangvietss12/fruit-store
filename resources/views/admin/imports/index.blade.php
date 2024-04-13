@extends('layouts.admin')

@section('content')
    @if(session('message') == 'Thêm thành công!')
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

        {{session('message')}}
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title">Danh sách nhập hàng</h3>
    </div>

    <div class="form-container mt-3">
        <form action="{{ route('import.search') }}" method="get" class="d-flex align-items-center flex-wrap">
            @csrf
            <div class="form-group" style="width: 250px">
                <label>Nhà cung cấp:</label>
                <select class="js-example-basic-single" name="vendor" style="width:100%">
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
            <button type="submit" class="btn btn-search d-flex ml-2">
                <span class="mdi mdi-magnify mr-1"></span>
                Tìm kiếm
            </button>
        </form>
    </div>

    <div class="d-flex justify-end my-3">
        <a class="btn btn-success d-flex" href="{{route('import.create')}}" role="button">
            <span class="mdi mdi-plus mr-1"></span>
            Thêm
        </a>
    </div>

    @if(!empty($data) && !$data->isEmpty())
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Tên nhà cung cấp </th>
                                        <th> Ngày nhập hàng </th>
                                        <th> Thành tiển </th>
                                        <th> Hành động </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->vendor->name}}</td>
                                        <td>{{date("d/m/Y", strtotime($item->created_at))}}</td>
                                        <td>{{number_format($item->total)}}đ</td>
                                        <td>
                                            <div class="d-flex justify-center">
                                                <a class="btn btn-primary ml-2 d-flex" target="_blank" href="{{route('import.view', ['id' => $item->id])}}" role="button">
                                                    <span class="mdi mdi-eye-outline mr-1"></span>
                                                    Xem chi tiết
                                                </a>
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
    @else
        <p class="text-notfound">Không có phiếu nhập hàng nào</p>
    @endif
@stop
