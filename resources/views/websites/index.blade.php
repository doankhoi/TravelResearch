@extends('layouts.master')
@section('title', 'トップ')

@section('content')
    @include('elements.flash_notification')
    <div class="panel panel-primary">
        <div class="panel-heading">トップ</div>
        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">■ Facebook情報の取得</div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-7 col-sm-offset-5">
                            @if (!Session::get('face_logined', false))
                                <a href="{!! route('facebook.login') !!}" class="btn btn-primary bt-login">
                                    Log in with facebook
                                </a>
                            @else 
                                <a href="{!! route('facebook.login') !!}" class="btn btn-warning bt-login disabled">
                                    Log in with facebook
                                </a>
                                <span class="account-login">
                                    Account: 
                                    <b>{!! Session::get('username_loged_face', "Noname") !!}</b>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="box-control">
                            <div>
                                <div class="row">
                                    <label class="control-label lb-top">
                                        1. 自身のページで「いいね！」をしているページのリストを取得（更新）します。
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-1 wr-action">
                                    @if (!Session::get('face_logined', false))
                                        <a href="javascript:void(0)" class="btn btn-default disabled bt-disable">
                                            リスト取得（更新）
                                        </a>
                                    @else
                                        <a href="{!! route('list.only.face') !!}" class="btn btn-default btn-gray">
                                            リスト取得（更新）
                                        </a>
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <label class="control-label lb-top">
                                        ２．１で取得したリストの基本情報を取得（更新）します。
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-1 wr-action">
                                    @if (!Session::get('face_logined', false))
                                        <a href="javascript:void(0)" class="btn btn-default disabled bt-disable">
                                            基本情報取得（更新)
                                        </a>
                                    @else
                                        <a href="{!! route('list.all.face') !!}" class="btn btn-default btn-gray">
                                            基本情報取得（更新)
                                        </a>
                                    @endif
                                    </div>
                                    @if (!Session::get('face_logined', false))
                                        <div class="col-sm-4 col-sm-offset-1 wr-action">
                                            <a href="javascript:void(0)" class="link-csv">取得状況一覧</a>
                                        </div>
                                    @else
                                       <div class="col-sm-4 col-sm-offset-1 wr-action">
                                            <a href="{!! route('list.face') !!}" class="link-csv">取得状況一覧</a>
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if (!Session::get('face_logined', false))
                                        <div class="col-sm-2 col-sm-offset-1 wr-action">
                                            <a href="{!! route('list.face.download') !!}" class="btn btn-default disabled bt-disable">
                                                CSVダウンロード
                                            </a>
                                        </div>
                                    @else
                                       <div class="col-sm-2 col-sm-offset-1 wr-action">
                                            <a href="{!! route('list.face.download') !!}" class="btn btn-default btn-gray">
                                                CSVダウンロード
                                            </a>
                                        </div>
                                    @endif
            
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">■ Twitter情報の取得</div>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-7 col-sm-offset-5">
                                @if (!Session::get('twitter_loged', false))
                                    <a href="{!! route('twitter.login') !!}" class="btn btn-primary bt-login">
                                        Log in with twitter
                                    </a>
                                @else
                                    <a href="{!! route('twitter.login') !!}" class="btn btn-warning bt-login disabled">
                                        Log in with twitter
                                    </a>
                                    <span class="account-login">
                                        Account: 
                                        <b>
                                        {!! Session::get('username_loged_twitter', "Noname") !!}
                                        </b>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="box-control">
                            <div>
                                <div class="row">
                                    <label class="control-label lb-top">
                                        １．自身の登録したTwitterページの情報を登録（更新）します。
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-1 wr-action">
                                        @if (!Session::get('twitter_loged', false))
                                            <a href="{!! route('add.twitter') !!}" class="btn btn-default disabled bt-disable">
                                                リスト登録
                                            </a>
                                        @else
                                            <a href="{!! route('add.twitter') !!}" class="btn btn-default btn-gray">
                                                リスト登録
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <label class="control-label lb-top">
                                        ２．１で取得したリストのアカウント情報を取得（更新）します。
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-1 wr-action">
                                        @if (!Session::get('twitter_loged', false))
                                            <a href="{!! route('list.all.twitter') !!}" class="btn btn-default disabled bt-disable">
                                                基本情報取得（更新）
                                            </a>
                                        @else
                                            <a href="{!! route('list.all.twitter') !!}" class="btn btn-default btn-gray">
                                                基本情報取得（更新）
                                            </a>
                                        @endif
                                    </div>
                                    <div class="col-sm-4 col-sm-offset-1 wr-action">
                                        @if (!Session::get('twitter_loged', false))
                                            <a href="javascript:void(0)" class="link-csv">取得状況一覧</a>
                                        @else
                                            <a href="{!! route('list.twitter') !!}" class="link-csv">取得状況一覧</a>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-1 wr-action">
                                        @if (!Session::get('twitter_loged', false))
                                            <a href="{!! route('list.twitter.download') !!}" class="btn btn-default disabled bt-disable">
                                                CSVダウンロード
                                            </a>
                                        @else
                                            <a href="{!! route('list.twitter.download') !!}" class="btn btn-default btn-gray">
                                                CSVダウンロード
                                            </a>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@stop