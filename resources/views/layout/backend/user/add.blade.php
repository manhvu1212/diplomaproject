<?php
/**
 * Created by PhpStorm.
 * User: manhv
 * Date: 20/03/2016
 * Time: 9:24 AM
 */
?>

@extends('layout.backend.master')

@section('style')
    <link rel="stylesheet" href="/css/user.css">
    @endsection

    @section('script')
            <!-- Jquery Validate -->
    <script src="/assets/backend/AdminLTE-2.3.0/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="/js/user.js"></script>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Thành viên
            <small>preview of simple tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{!! route('admin::dashboard') !!}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{!! route('admin::user::index') !!}">Thành viên</a></li>
            <li class="active">Thêm mới</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm mới</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="/admin/user/save" id="form-add-user">
                        {!! csrf_field() !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Chức vụ</label>

                                <div class="col-sm-10 col-md-8">
                                    <div class="row">
                                        @foreach($roles as $role)
                                            <div class="col-sm-4">
                                                <div class="checkbox icheck">
                                                    <label>
                                                        <input type="checkbox" value="{!! $role['slug'] !!}"
                                                               name="roles[]">
                                                        {!! trans('role.' . $role['slug']) !!}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Họ và tên</label>

                                <div class="col-sm-5 col-md-4">
                                    <input type="text" name="last_name" class="form-control" placeholder="Họ">
                                </div>

                                <div class="col-sm-5 col-md-4">
                                    <input type="text" name="first_name" class="form-control" placeholder="Tên">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10 col-md-8">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Mật khẩu</label>

                                <div class="col-sm-10 col-md-8">
                                    <div class="input-group">
                                        <input readonly type="text" name="password" class="form-control"
                                               placeholder="Mật khẩu">
                                        <span class="input-group-btn">
                                            <button type="button" id="generatePassword" class="btn btn-info btn-flat">
                                                Khởi tạo
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-flat btn-success center-block">Tạo mới</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection