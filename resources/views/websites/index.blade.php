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
                            <div class="col-sm-5 col-sm-offset-5">
                            @if (!Session::get('face_logined', false))
                                <a href="{!! route('facebook.login') !!}" class="btn btn-primary bt-login">
                                    Login with facebook
                                </a>
                            @else 
                                <a href="{!! route('facebook.login') !!}" class="btn btn-warning bt-login disabled">
                                    Login with facebook
                                </a>
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
                                        <a href="javascript:void(0)" class="btn btn-default disabled btn-gray">
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
                                        <a href="javascript:void(0)" class="btn btn-default disabled btn-gray">
                                            基本情報取得（更新)
                                        </a>
                                    @else
                                        <a href="{!! route('list.all.face') !!}" class="btn btn-default btn-gray">
                                            基本情報取得（更新)
                                        </a>
                                    @endif
                                    </div>
                                    <div class="col-sm-4 col-sm-offset-1 wr-action">
                                        <a href="{!! route('list.face') !!}" class="link-csv">取得状況一覧</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-1 wr-action">
                                        <a href="{!! route('list.face.download') !!}" class="btn btn-default btn-gray">
                                            CSVダウンロード
                                        </a>
                                    </div>
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
                            <div class="col-sm-5 col-sm-offset-5">
                                @if (!Session::get('twitter_loged', false))
                                    <a href="{!! route('twitter.login') !!}" class="btn btn-primary bt-login">
                                        Login with twitter
                                    </a>
                                @else
                                    <a href="{!! route('twitter.login') !!}" class="btn btn-warning bt-login disabled">
                                        Login with twitter
                                    </a>
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
                                        <a href="{!! route('add.twitter') !!}" class="btn btn-default btn-gray">
                                            リスト登録
                                        </a>
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
                                        <a href="{!! route('list.all.twitter') !!}" class="btn btn-default btn-gray">
                                            基本情報取得（更新）
                                        </a>
                                    </div>
                                    <div class="col-sm-4 col-sm-offset-1 wr-action">
                                        <a href="{!! route('list.twitter') !!}" class="link-csv">取得状況一覧</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2 col-sm-offset-1 wr-action">
                                        <a href="{!! route('list.twitter.download') !!}" class="btn btn-default btn-gray">
                                            CSVダウンロード
                                        </a>
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