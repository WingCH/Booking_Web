@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Login
                </div>
                <div class="panel-body">
                    <form action="{{ url('/login') }}" class="form-horizontal" method="POST" role="form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">
                                E-Mail Address
                            </label>
                            <div class="col-md-6">
                                <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">
                                Password
                            </label>
                            <div class="col-md-6">
                                <input class="form-control" id="password" name="password" type="password">
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-btn fa-sign-in">
                                    </i>
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
