@extends('layouts.app')

@section('content')
<link href="/resources/admin/styles.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.0/fullcalendar.min.css" rel="stylesheet"/>
<link href="/resources/lib-fullcalendar/scheduler.css" rel="stylesheet"/>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li class="current">
                        <a href="{{ url('/bookingCalendar') }}">
                            <i class="glyphicon glyphicon-calendar">
                            </i>
                            Calendar
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/bookingTable') }}">
                            <i class="glyphicon glyphicon-list">
                            </i>
                            Bookings
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/userTable') }}">
                            <i class="glyphicon glyphicon-record">
                            </i>
                            User
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/roomTable') }}">
                            <i class="glyphicon glyphicon-modal-window">
                            </i>
                            Room
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-10">
            <div class="content-box-large">
                <div id="calendar">
                </div>
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
<script src="/resources/bookingCalendar/bookingCalendar.js" type="text/javascript">
</script>
@endsection
