<?php
/**
 * Created by PhpStorm.
 * User: manhv
 * Date: 06/03/2016
 * Time: 9:58 PM
 */
?>

@extends('layout.backend.master')

@section('style')
        <!-- DataTables -->
<link rel="stylesheet" href="/assets/backend/AdminLTE-2.3.0/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="/css/user.css">
@endsection

@section('script')
        <!-- DataTables -->
<script src="/assets/backend/AdminLTE-2.3.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/backend/AdminLTE-2.3.0/plugins/datatables/dataTables.bootstrap.min.js"></script>

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
            <li class="active">Thành viên</li>
        </ol>
    </section>

    <section class="content">
        @if (session()->has('status'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert {!! session('status') ? 'alert-success' : 'alert-danger' !!} alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>
                            <i class="icon fa {!! session('status') ? 'fa-check' : 'fa-ban' !!}"></i> {!! session('status') ? 'Thành công!' : 'Lỗi!' !!}
                        </h4>
                        {!! session('notification') !!}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="{!! route('admin::user::index') !!}"
                           class="btn btn-primary btn-flat btn-role {!! (Request::is('admin/user')) ? 'disabled' : '' !!}">
                            {!! trans('role.all') !!}
                            &nbsp;
                            <span class="badge bg-yellow">
                                {!! $countUser !!}
                            </span>
                        </a>
                        @foreach($roles as $role)
                            <a href="{!! route('admin::user::role', ['role' => $role['slug']]) !!}"
                               class="btn btn-primary btn-flat btn-role {!! (Request::is('admin/user/role/' . $role['slug'])) ? 'disabled' : '' !!}">
                                {!! trans('role.' . $role['slug']) !!}
                                &nbsp;
                                <span class="badge bg-yellow">{!! count($role['user_id']) !!}</span>
                            </a>
                        @endforeach
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="table-all-user" class="table table-hover">
                            <thead>
                            <tr>
                                <th><input type="checkbox" class="checkall"></th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Trạng thái</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="user[]" value="{!! $user['_id'] !!}">
                                    </td>
                                    <td>{!! $user['first_name'] . " " . $user['last_name'] !!}</td>
                                    <td>{!! $user['email'] !!}</td>
                                    <td>
                                        @if($user['activation'] == 1)
                                            <span class="label label-success">Đã kích hoạt</span>
                                        @elseif($user['activation'] == 0)
                                            <span class="label label-warning">Đang chờ</span>
                                        @else
                                            <span class="label label-danger">Chưa kích hoạt</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{!! route('admin::user::view', $user['_id']) !!}"
                                           class="btn btn-xs btn-info btn-flat" title="xem">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{!! route('admin::user::edit', $user['_id']) !!}"
                                           class="btn btn-xs btn-warning btn-flat" title="sửa">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-danger btn-flat"
                                           data-user-id="{!! $user['_id'] !!}"
                                           data-csrf-token="{!! csrf_token() !!}"
                                           data-toggle="confirmation"
                                           data-placement="left"
                                           data-title="Xóa?"
                                           data-btn-ok-label="Có"
                                           data-btn-cancel-label="Hủy"
                                           data-singleton="true"
                                           data-popout="true"
                                           data-on-confirm="USER.deleteUser">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>

@endsection