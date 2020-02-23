<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Добавление филиала в АРМ &leftarrow;АПАБ&rightarrow;</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        .form label{
            font-size: 20px;
        }
        .form{
            max-width: 400px;
            margin: auto;
            margin-top: 200px;
        }
    </style>
</head>
<body>
<div class="flex-top position-ref full-height">
    <div class="content">
        @include('admin.parts.nav')
        <div class="title m-b-md">
            Добавление филиала
        </div>

        <div class="form">
            @include('admin.parts.messages')
            {{ Form::open(['action' => 'AdminController@pageAddFillials']) }}
                @csrf
            <div class="form-group">
                {{ Form::label('name_filial', 'Название филиала') }}
                {{ Form::text('name_filial', $name_filial,[
                    'class' => 'form-control',
                    'required' => true,
                    'autofocus' => true,
                    ])
                }}
            </div>
            <div class="form-group form-actions">
                {{ Form::submit('Добавить', array('class' => 'btn btn-primary')) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
</body>
</html>
