<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!--标准mui.css-->
    <link rel="stylesheet" href="{{asset("mui/css/mui.min.css")}}">
    <!--App自定义的css-->
    <link rel="stylesheet" type="text/css" href="{{asset("mui/css/app.css")}}" />
    @yield('style')
</head>

<body>
<header class="mui-bar mui-bar-nav">
    <h1 class="mui-title"></h1>
</header>
<div class="mui-content">
    @section('content')
        This is the master sidebar.
    @show


</div>
<script src="{{asset("mui/js/mui.min.js")}}"></script>
</body>

</html>