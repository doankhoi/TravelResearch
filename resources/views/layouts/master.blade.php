<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="">
        <meta name="copyright" content="">
        <title>@yield('title')</title>
        <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/bootstrap-datepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/website.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="header">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-brand">
                        {!! link_to_route('top', 'Get system data', null) !!}
                    </div>
                    <a href="{!! url('auth/logout') !!}" class="btn btn-primary navbar-btn pull-right btn-action">
                        ログアウト
                    </a>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="wrap">
                @yield('content')
            </div>
        </div>

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-datepicker.ja.js') }}"></script>
        <script src="{{ asset('assets/js/moment-with-locales.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
        @yield('script')
    </body>
</html>
