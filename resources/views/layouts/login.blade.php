<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="">
        <meta name="copyright" content="">
        <title>@yield('title')</title>
        <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="header">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <div class="navbar-brand">TravelResearch</div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="wrap">
                @yield('content')
            </div>
        </div>

        @yield('script')
    </body>
</html>
