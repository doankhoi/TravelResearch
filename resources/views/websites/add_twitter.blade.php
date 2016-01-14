@extends('layouts.master')
@section('title', 'Twitterアカウントの登録')

@section('content')
    @include('elements.flash_notification')
    <div class="panel panel-primary">
        <div class="panel-heading">■ Twitterアカウントの登録</div>
        <div class="panel-body">
            <div class="col-sm-offset-1">
                <div class="row">
                    {!! Form::open(['route' => 'add.twitter.store', 'class' => 'form-inline']) !!}
                        <div class="form-group">
                            {!! Form::text('screen_name', null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('登録', ['class' => 'btn btn-default btn-gray', 'id' => 'btn-add-twitter']) !!}
                    {!! Form::close() !!}
                </div>
                <br>
                <div class="row">
                    ※取得したいTwitterのSCREEN_NAMEにあたる内容を登録します。
                </div>
            </div>
        </div>
    </div>
@stop