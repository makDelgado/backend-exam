@extends('../../layouts.app')

@section('content')
    <div id="app">
        <div class="row" style="width:100%">
            <div class="col-md-3">
                <side-bar-component />
            </div>
            <div class="col-md-8">
                <videos-page />
            </div>
        </div>
    </div>
@endsection