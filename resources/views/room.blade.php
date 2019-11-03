@extends('layouts.app')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css" rel="stylesheet"/>
    <link href="/resources/lib-fullcalendar/scheduler.css" rel="stylesheet"/>
    <div class="container">
        <div class="row">
            <input id="room_id" name="room_id" type="hidden" value="{{ $room->id }}"/>
            <input id="room_name" name="room_name" type="hidden" value="{{ $room->name }}"/>
            @if (!Auth::guest())
                <input id="user_id" name="user_id" type="hidden" value="{{ Auth::user()->id }}"/>
            @endif
            <div class="col-md-12">
                <div class="jumbotron">
                    <h1>
                        {{ $room->name }}
                    </h1>
                    <p>
                        <i aria-hidden="true" class="fa fa-map-marker">
                        </i>
                        {{ $room->address }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div id="calendar">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="/resources/lib-fullcalendar/moment.js" type="text/javascript">
    </script>
    <script src="/resources/lib-fullcalendar/moment-with-locales.js" type="text/javascript">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.js" type="text/javascript">
    </script>
    <script src="/resources/lib-fullcalendar/scheduler.js" type="text/javascript">
    </script>
    <script src="/resources/room/room.js" type="text/javascript">
    </script>
@endsection
