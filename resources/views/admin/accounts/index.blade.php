@extends('layouts.admin')

@section('content')
    @if(session('message') == 'Cập nhật thành công!')
        <div class="alert alert-warning">
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
        <h3 class="page-title"> Danh sách tài khoản</h3>
    </div>

    <div class="form-container my-3">
        <form action="{{ route('account.search') }}" method="post" class="d-flex align-items-center flex-wrap">
            @csrf
            <div class="form-group" style="width: 200px">
                <label for="account_name">Tên tài khoản:</label>
                <input type="text" class="form-control" name="account_name" placeholder="Nhập từ khóa...">
            </div>
            <div class="form-group ml-2" style="width: 200px">
                <label for="account_email">Email:</label>
                <input type="text" class="form-control" name="account_email" placeholder="Nhập từ khóa...">
            </div>
            <div class="form-group ml-2" style="">
                <label for="account_name">Trạng thái:</label>
                <select class="js-example-basic-single" name="account_status" style="width:100%">
                    <option value="" selected disable>Chọn trạng thái</option>
                    <option value="active">Hoạt động</option>
                    <option value="deactive">Bị khóa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-search d-flex ml-2">
                <span class="mdi mdi-magnify mr-1"></span>
                Tìm kiếm
            </button>
        </form>
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
                                <th> Tên tài khoản </th>
                                <th> Email </th>
                                <th> Trạng thái </th>
                                <th> Hành động </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td
                                            class="{{$item->status === 'active' ? '' : 'text-danger'}}"
                                        >
                                            {{$item->status === 'active' ? 'Hoạt động' : 'Bị khóa'}}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-center">
                                                <a class="btn btn-primary ml-2 d-flex" href="{{route('account.view', ['id' => $item->id])}}" role="button">
                                                    <span class="mdi mdi-eye-outline mr-1"></span>
                                                    Xem chi tiết
                                                </a>
                                                <a class="btn btn-warning ml-2 d-flex" href="{{route('account.edit', ['id' => $item->id])}}" role="button">
                                                    <span class="mdi mdi-pencil mr-1"></span>
                                                    Sửa trạng thái
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

        {{ $data->links('vendor.pagination') }}
    @else
        <p class="text-notfound text-black">Không có tài khoản nào</p>
    @endif
@stop
