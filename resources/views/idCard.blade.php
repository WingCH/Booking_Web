@extends('layouts.app')


@section('content')

<div class="container">

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
        <div class="col-sm-4 col-sm-offset-4">
            <div class="thumbnail">
                <div class="row">
                    <div class="col-sm-3">
                        {{-- <div id="qrCode">
                        </div> --}}
                        <img src="/photo/userIcon.png" class="img-responsive" alt="Responsive image">

                    </div>
                    <div class="col-sm-6">
                        <div class="caption">
                            <h4>
                                {{ Auth::user()->name }}
                            </h4>
                            <p>
                                {{ Auth::user()->email }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('js')
<script src="/resources/lib-kjua/kjua-0.1.1.min.js" type="text/javascript">
</script>
<script src="/resources/idCard/idCard.js" type="text/javascript">
</script>
@endsection
