<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li  class="{{ Request::is('/') || Request::is('client') || Request::is('client/*') ? 'active' : '' }}">
                            <a href="/client">Clients</a>
                        </li>
                        <li  class="{{ Request::is('reports') ? 'active' : '' }}"><a href="/reports">Reports</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
        </nav>
        <div class="content">
            @yield('content')
        </div>
    </div>
    <link rel="stylesheet" href="/js/app.js">
</body>
</html>