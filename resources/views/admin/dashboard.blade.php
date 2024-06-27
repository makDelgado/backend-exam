@extends('../layouts.app')

@section('content')
    

<div class="container">
<div id="app">
        <side-bar-component></side-bar-component>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    hir
                
        </div>
    </div>
</div>
@endsection
