@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
        </section>
        <section class="content">
            <div class="container-fluid">
                @if(strtolower(env('APP_ENV','staging')) != 'production')
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        This is a staging and test environment. Data will not be persistent! <br/>
                        Env: {{env('APP_ENV','staging')}}
                    </div>
                @else
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Info!</h5>
                        This is still an early Alpha version of EAM.Watch v3
                        Some things may not work exactly as expected; and not all features are implemented yet.

                        Data will remain persistent.
                    </div>
                @endif
                <router-view></router-view>
            </div>
        </section>
    </div>
@endsection
