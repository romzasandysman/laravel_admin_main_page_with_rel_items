<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Добавление станции в АРМ &leftarrow;АПАБ&rightarrow;</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/addStation.css') }}" rel="stylesheet">
</head>
<body>
<div class="flex-top position-ref full-height">
    <div class="content">
        @include('admin.parts.nav')
        <div class="title m-b-md">
            Добавление станции
        </div>

        <div class="form">
            @include('admin.parts.messages')
            {{ Form::open(['action' => 'AdminController@pageAddStation']) }}
            @csrf
            <div class="form-group">
                {{ Form::label('name', 'Название станции') }}
                {{ Form::text('name', $data_station['NAME_STATION'],[
                    'class' => 'form-control',
                    'required' => true,
                    'autofocus' => true,
                    ])
                }}
            </div>

            <div class="form-group">
                {{ Form::label('link', 'Ссылка на сайт станции') }}
                {{ Form::text('link', $data_station['LINK_STATION'],[
                    'class' => 'form-control',
                    'required' => true,
                    ])
                }}
            </div>
            <div class="form-group">
                {{ Form::label('filial', 'Филиал станции',['class' => 'ref-filial'])}}
                {{ Form::select('filial', $arFilials,$data_station['ID_FILIAL'])}}
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
