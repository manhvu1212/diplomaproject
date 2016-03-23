@extends('layout.backend.master')

@section('style')
    <link rel="stylesheet" href="/css/media.css">
@endsection

@section('script')
    <script src="/js/media.js"></script>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Thư viện
            <small>nội dung</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin::dashboard') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Thư viện</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="media-filter">
                    <button type="button" class="btn btn-sm btn-info btn-flat">
                        Thêm tệp mới
                    </button>
                    <select class="">
                        <option>Tất cả các loại tệp</option>
                        <option>Ảnh</option>
                        <option>Tài liệu</option>
                        <option>Các loại khác</option>
                    </select>
                    <select class="">
                        <option>Tất cả các ngày</option>
                        <option>Tháng Ba 2016</option>
                        <option>Tháng Mười Hai 2015</option>
                        <option>Tháng Chín 2015</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
@endsection