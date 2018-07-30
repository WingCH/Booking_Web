@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Add Room form
                </div>
                <div class="panel-body">
                    <form action="{{ url('/addRoom') }}" class="form-horizontal" enctype="multipart/form-data" id="formID" method="POST" name="addRoomForm" role="form">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="room_Name">
                                <i aria-hidden="true" class="fa fa-tag">
                                </i>
                                Room name
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" id="room_Name" name="name" required="" type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="room_description">
                                <i aria-hidden="true" class="fa fa-quote-left">
                                </i>
                                Description
                            </label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="room_description" name="description" required="" rows="3" type="text"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="room_address">
                                <i aria-hidden="true" class="fa fa-map-marker">
                                </i>
                                Address
                            </label>
                            <div class="col-sm-10">
                                <input class="form-control" id="room_address" name="address" required="" type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input_Name">
                                <i aria-hidden="true" class="fa fa-picture-o">
                                </i>
                                Background
                            </label>
                            <div class="col-sm-10">
                                <input accept="image/*" id="room_background" name="background" required="" type="file"/>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="panel-footer">
                    <div class="text-right">
                        <button class="btn btn-danger" form="formID" id="Submit" type="submit">
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
