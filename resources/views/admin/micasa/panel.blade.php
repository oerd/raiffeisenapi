<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shtepia ime</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}" />

    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/canvasjs.min.js')}}"></script>
    <script src="{{asset('js/jquery.canvasjs.min.js')}}"></script>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="{{asset('img/logo.png')}}" />
            <span>SHTEPIA IME <text>ADMIN PANEL</text></span>
            <i id="menu-col" class="material-icons">&#xE5D2;</i>
        </div>
        <div class="search">
            <form class="form-horizontal" method="POST" action="{{ url('/admin/search') }}">
                {{ csrf_field() }}
               <input type="text" id="search" name='keyword' placeholder="Search..." />
                <i class="material-icons">&#xE8B6;</i>
               <button type="submit" style="display:none;"></button>
            </form>

        </div>
        <div class="addnew">
            <i class="material-icons">&#xE148;</i>
            <a href="{{url('/admin/add/new')}}"><span>Add new</span></a>
        </div>
        <div class="rightcontroll">
            <img src="https://www.dentem.co/img/placeholder-logo.jpg" />
            <span>Raiffeisen admin</span>
            <i id="admindata" class="material-icons">&#xE313;</i>
            <ul class='maindrop'>
                <li><a href="{{url('admin/change')}}"><i class="material-icons">&#xE8B8;</i> Settings</a></li>
                <li><i class="material-icons">&#xE8AC;</i> Logout</li>
            </ul>
        </div>
    </div>
    <div class="menu">
        <div class="adminstatus">
            <div>
                <img src="https://www.dentem.co/img/placeholder-logo.jpg" />
                <span>Raiffeisen admin<text><i class="material-icons">&#xE061;</i> Online</text></span>
                    <a href="{{ route('logout') }}" style="color:white;"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i id="logoutclick" class="material-icons">&#xE8AC;</i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
            </div>
        </div>
        <ul>
            <li id="dash" ><a href="{{url('/admin')}}"><i class="material-icons">&#xE871;</i> <span>Dashboard</span></a></li>
            <li id="list"><a href="{{url('/admin/listings')}}"><i class="material-icons">&#xE871;</i> <span>Listings</span></a></li>
            <li><i class="material-icons">&#xE871;</i> <span>Insights</span></li>
            <li><a href="{{url('/admin/configuration')}}"><i class="material-icons">&#xE871;</i> <span>Configuration</span></a></li>
            <li><i class="material-icons">&#xE871;</i> <span>Clients</span></li>
            <li><a href="{{url('/admin/agency')}}"><i class="material-icons">&#xE871;</i> <span>Users</span></a></li>
        </ul>
    </div>
    @yield('content')
</body>
</html>
