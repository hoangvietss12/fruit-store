@extends('layouts.admin')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>

            {{ session('error') }}
        </div>
    @endif

    <div class="page-header">
        <h3 class="page-title"> Thêm phiếu nhập hàng </h3>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('import.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Chọn nhà cung cấp:</label>
                            <select class="js-example-basic-single" name="vendor_name" style="width:100%">
                                <option value="" selected disabled>Chọn nhà cung cấp</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                @endforeach
                            </select>
                            @error('vendor_name')
                                <p class="text-danger mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success mr-2">Tiếp tục</button>
                    </form>
                    <a class="btn btn-primary mt-3" href="{{ route('import.index') }}">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
@stop
