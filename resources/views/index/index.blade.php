@extends('layouts.index')

@section('content')
    <div class="row container-filials">
        <div class="offset-2 col-md-8 wrap-filials">
            @foreach ($filials as $filial)
                <div class="offset-2 col-md-7 filial-block">
                    <div class="block-img">
                        <img src="{{ asset('images/filial_block.png') }}">
                    </div>
                    <div class="col-md-9 filial-content">
                        <div class="filial-name">{{ $filial['NAME'] }}:</div>
                        @if (!empty($filial['STATIONS']))
                            <div class="filial-stations">
                                <ul>
                                    @foreach($filial['STATIONS'] as $station)
                                        <li><a target="_blank" href="{!! $station['LINK'] !!}">{{ $station['NAME'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
