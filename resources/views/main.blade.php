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
                {{-- @else
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-alert"></i> Info!</h5>
                        Welcome to Eam.Watch V3!<br />
                        This is a community log of Emergency Action Messages broadcasted through the High Frequency Global Communication System.<br />
                        Please consider joining the community and adding the messages you capture while monitoring.<br />
                        More details can be gained through our discord server.
                    </div> --}}
                @endif
                <router-view></router-view>
            </div>
        </section>
    </div>
@endsection
