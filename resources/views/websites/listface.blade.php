@extends('layouts.master')
@section('title', 'List facebook')

@section('content')
    @include('elements.flash_notification')
    <div class="panel panel-primary">
        <div class="panel-heading">■ Facebook情報一覧</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4 pull-left">
                    全体：　{!! $listFanpage->total() !!}件
                </div>
                <div class="col-sm-2 pull-right">
                    <a href="{!! $listFanpage->previousPageUrl() !!}" class="">前へ</a>&nbsp;&nbsp;
                    <a href="{!! $listFanpage->nextPageUrl() !!}" class="">次へ</a>
                </div>
            </div>
            <br>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>ページ名</th>
                        <th>ページのID</td>
                        <th>ページの情報</th>
                        <th>いいね！数</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $k = 1; ?>
                    @foreach ($listFanpage as $item)
                    <tr>
                        <td>{!! $k !!}</td>
                        <td>{!! $item->name2 !!}</td>
                        <td>{!! $item->serialno !!}</td>
                        <td>{!! $item->about !!}</td>
                        <td>{!! $item->likes !!}</td>
                    </tr>
                        <?php $k++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop