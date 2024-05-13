@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title">Lịch sử truy cập</h3>
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
                                        <th> Tài khoản </th>
                                        <th> Email </th>
                                        <th> Trình duyệt truy cập</th>
                                        <th> Địa chỉ IP </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $index => $item)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$item->user->name}}</td>
                                        <td>{{$item->user->email}}</td>
                                        <td>{{$item->user_agent}}</td>
                                        <td>{{$item->ip_address}}</td>
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
        <p class="text-notfound">Không có lịch sử truy cập nào</p>
    @endif
@stop
