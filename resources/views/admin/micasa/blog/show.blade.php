@extends('admin.micasa.panel')

@section('content')
    <style>
        .btn {
            margin-left: 35px;
        }
    </style>
    <div class="maincontent">
        <div class="adminroute">
            <i class="material-icons">&#xE88A;</i>
            <span> <b> / </b> Shtepia Ime Admin Panel <b> / </b> </span>
            <span class="partup"> Blog </span>
        </div>
        <div class="adminpage">
            <span class="partdown">BLOG</span>
            <text class="partdesc">Blog for Shtepia ime</text>
        </div>
        <a class="btn btn-danger pull-left" href="{{url('/admin/blog/category/add')}}">Add category</a>
        <a class="btn btn-danger pull-left" href="{{url('/admin/blog/posts/add')}}">Add blog</a>
    </div>

@endsection
