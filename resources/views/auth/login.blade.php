@extends('layouts.login')
@section('title', 'ログイン')

@section('content')
    {!! Form::open(['url' => 'auth/login', 'class' => 'form-horizontal']) !!}
        <div class="col-xs-8 col-xs-offset-2">
            <h3 class="form-group text-center fr-margin-bottom">ログイン</h3>
            @include('elements.flash_notification')
            <div class="form-group">
                <label for="log" class="col-xs-2 margin-label">ログインＩＤ</label>
                <div class="col-xs-9 input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-user"></i>
                    </span>
                    {!! Form::text('log', null, ['class' => 'form-control', 'maxlength' => 100]) !!}
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-xs-2 margin-label">パスワード</label>
                <div class="col-xs-9 input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-lock"></i>
                    </span>
                    {!! Form::password('password', ['class' => 'form-control', 'maxlength' => 100]) !!}
                </div>
            </div>
            <div class="form-group text-center">
                {!! Form::submit('ログイン', ['class' => 'btn btn-primary col-xs-3 col-xs-offset-4']) !!}
            </div>
            <div class="clearfix"></div>
        </div>
    {!! Form::close() !!}
@stop