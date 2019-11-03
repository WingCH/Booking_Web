@extends('layouts.app')

@section('content')
    {{  Debugbar::info($rooms->toArray()) }}
    <div class="container">
        <div class="row">
            @foreach ($rooms as $room)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="thumbnail" id="{{ $room->id }}">
                        <a href="/room/{{ $room->id }}">
                            <img alt="text" class="img-responsive img-rounded " src="{{ $room->backgroundImage }}">
                            <div class="caption">
                                <h2>{{ $room->name }}</h2>
                                <div class="row">
                                    <div class="col-xs-12 text-center ">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <small class="text-muted">{{ $room->address }}</small>
                                    </div>
                                </div>
                            </div>
                        </a>
                        {{-- </img> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('js')
    {{-- own js --}}
{{--    <script src="/resources/home/home.js" type="text/javascript">--}}
{{--    </script>--}}
@endsection

@section('css')
    <style>
    a {
        text-decoration: none !important;
    }
    </style>
@endsection
