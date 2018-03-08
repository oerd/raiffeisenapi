<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

    <title>Shtepia ime</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/canvasjs.min.js"></script>
    <script src="js/jquery.canvasjs.min.js"></script>

    <style>
        @font-face {
            font-family: 'Lato';
            font-style: normal;
            font-weight: 400;
            src: local('Lato Regular'), local('Lato-Regular'), url(http://themes.googleusercontent.com/static/fonts/lato/v7/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format('woff');
        }

        body {
            background: #3c3b3b ;
            font-family: "Lato" ;
        }
        .wrap {
            width:250px;
            height: auto;
            margin: auto;
            margin-top: 10%;
        }
        .avatar {
            width: 100%;
            margin: auto;
            width: 83px;
            border-radius: 100px;
            height: 45px;
            background: #3c3b3b;
            position: relative;
            bottom: -15px;
        }
        .avatar img {
            border-radius: 100px;
            margin: auto;
            border: 3px solid #fff;
            display: block;
        }
        .wrap input {
            border: none;
            background: #fff;
            font-family:Lato ;
            font-weight:700 ;
            display: block;
            height: 40px;
            outline: none;
            width: calc(100% - 24px) ;
            margin: auto;
            padding: 6px 12px 6px 12px;
        }
        .bar {
            width: 100%;
            height: 1px;
            background: #fff ;
        }
        .bar i {
            width: 95%;
            margin: auto;
            height: 1px ;
            display: block;
            background: #d1d1d1;
        }
        .wrap input[type="text"] {
            border-radius: 7px 7px 0px 0px ;
        }
        .wrap input[type="password"] {
            border-radius: 0px 0px 7px 7px ;
        }
        .forgot_link {
            color: #83afdf ;
            color: #83afdf;
            text-decoration: none;
            font-size: 11px;
            position: relative;
            left: 193px;
            top: -36px;
        }
        .wrap button {
            width: 100%;
            border-radius: 7px;
            background: #ec1c24;
            text-decoration: center;
            border: none;
            color: #ffffff;
            margin-top: 15px;
            padding-top: 14px;
            padding-bottom: 14px;
            outline: none;
            font-size: 13px;
            border-bottom: 3px solid #ec1c24;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

        <div class="wrap">
            <div class="avatar">
                <img src="http://shtepiaime.al/img/logo.png">
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="email" required autofocus>

            <div class="bar">
                <i></i>
            </div>
            <input id="password" type="password" name="password" placeholder="password" required>

            <!--<a href="" class="forgot_link">forgot ?</a>-->
            <button type="submit" >
                Login
            </button>
        </div>


    </form>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
