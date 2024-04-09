@extends('layouts.admin')

@section('content')
    @if(session('message') == 'Cập nhật thành công!')
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{session('message')}}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Danh sách tài khoản</h3>
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
                                    <td>{{$item->status}}</td>
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

    {{ $data->links() }}
@stop
