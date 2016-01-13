@extends('layouts.master')
@section('title', 'Twitter情報一覧')

@section('content')
    @include('elements.flash_notification')
    <div class="panel panel-primary">
        <div class="panel-heading">■ Twitter情報一覧</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-4 pull-left">
                    全体：　{!! $listTwitter->total() !!}件
                </div>
                <div class="col-sm-8">
                    @include('elements.paginate', ['records' => $listTwitter])
                </div>
            </div>
            <br>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>スクリーン名</th>
                        <th>ページ名</td>
                        <th>ページのURL</th>
                        <th>いいね！数</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $k = 1; ?>
                    @foreach ($listTwitter as $item)
                    <tr>
                        <td>{!! $k !!}</td>
                        <td>{!! $item->screen_name !!}</td>
                        <td>{!! $item->name !!}</td>
                        <td>{!! $item->entities_url_expanded_url !!}</td>
                        <td>{!! $item->followers_count !!}</td>
                    </tr>
                        <?php $k++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop