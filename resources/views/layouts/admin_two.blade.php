<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{ asset('admin/css/ch-ui.admin.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/css/font-awesome.min.css') }}">
	<script type="text/javascript" src="{{ asset('admin/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/ch-ui.admin.js') }}"></script>
    <!-- layer弹层 -->
    <script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/jquery-1.8.3.min.js')}}"></script>
</head>

<style>

/*  修正模板2 的 分页样式 */
        a{
            text-decoration:none;
        }
        a:hover {
     text-decoration: underline; 
}
    .result_content ul li span{
         padding:6px 12px;
    }
    </style>

@section('content')

@show
</html>
