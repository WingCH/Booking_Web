@extends('layouts.app') @section('content')
<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css" rel="stylesheet">
<div class="container">
  <div class="row">
    @if (Auth::guest())
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">
        </div>
        <div class="panel-body">
          Please login first
        </div>
      </div>
    </div>
    @else
    <div class="col-md-10 col-md-offset-1">
      <table data-check-on-init="true" data-mobile-responsive="true" data-search="true" data-show-columns="true" data-show-refresh="true" data-show-toggle="true" data-toggle="table" data-url="/getBookingList/{{ Auth::user()->id}}"
        id="historyTable">
        <thead>
          <tr>
            <th data-align="center" data-field="start" data-formatter="dateFormatter" data-sortable="true" data-valign="middle" data-width="15%">
              Date
            </th>
            <th data-align="center" data-field="room.name" data-valign="middle" data-width="20%">
              Room name
            </th>
            <th data-align="center" data-field="room.address" data-formatter="addressFormatter" data-valign="middle" data-width="5%">
              Address
            </th>
            <th data-align="center" data-field="start" data-formatter="startFormatter" data-sortable="true" data-valign="middle" data-width="10%">
              Start Time
            </th>
            <th data-align="center" data-field="end" data-formatter="endFormatter" data-sortable="true" data-valign="middle" data-width="10%">
              End Time
            </th>
            <th data-align="center" data-field="status" data-formatter="statusFormatter" data-sortable="true" data-valign="middle" data-width="5%" id="satus_th">
              Status
            </th>
            <th data-align="center" data-events="cancelEvents" data-field="id" data-formatter="buttonFormatter" data-valign="middle" data-width="">
            </th>
          </tr>
        </thead>
      </table>
    </div>
    @endif
  </div>
</div>
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" data-dismiss="modal">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <div class="row">
          <div id="qrCode" class="col-xs-offset-3">
          </div>
        </div>


      </div>
      {{-- <div class="modal-footer">
        <div class="col-xs-12">
          <p class="text-left">1. line of description<br>2. line of description <br>3. line of description</p>
        </div>
      </div> --}}
    </div>
  </div>
</div>
@endsection @section('js')
<script src="/resources/lib-kjua/kjua-0.1.1.min.js" type="text/javascript">
</script>
<script src="/resources/lib-fullcalendar/moment.js" type="text/javascript">
</script>
<script src="/resources/lib-fullcalendar/moment-with-locales.js" type="text/javascript">
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js">
</script>
<!-- Latest compiled and minified Locales -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/locale/bootstrap-table-en-US.min.js">
</script>
<script src="/resources/history/history.js">
</script>
@endsection
</link>
