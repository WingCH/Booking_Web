@extends('layouts.app')

@section('content')
<link href="/resources/admin/styles.css" rel="stylesheet"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css" rel="stylesheet"/>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li>
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
                    <li class="current">
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
                <table data-check-on-init="true" data-mobile-responsive="true" data-search="true" data-show-columns="true" data-show-refresh="true" data-show-toggle="true" data-toggle="table" data-url="http://www.booking.wingpage.net/getRoomList" id="roomTable">
                    <thead>
                        <tr>
                            <th data-align="center" data-field="id" data-sortable="true" data-valign="middle" data-width="5%">
                                id
                            </th>
                            <th data-align="center" data-field="name" data-sortable="true" data-valign="middle" data-width="30%">
                                Name
                            </th>
                            <th data-align="center" data-field="address" data-sortable="true" data-valign="middle" data-width="30%">
                                Address
                            </th>
                            <th data-align="center" data-events="deleteEvents" data-formatter="deleteButtonFormatter" data-valign="middle" data-width="">
                            </th>
                        </tr>
                    </thead>
                </table>
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
<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js">
</script>
<script src="/resources/roomTable/roomTable.js" type="text/javascript">
</script>
@endsection
