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

<!-- // <style type="text/css">
// 斜边栏的展开
//     .menu_box ul li ul.sub_menu{
//     	display:block;
//     }
// </style> -->

@section('content')

@show
</html>
