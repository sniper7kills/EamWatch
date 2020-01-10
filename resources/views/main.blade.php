@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
        </section>
        <section class="content">
            <div class="container-fluid">
                <router-view></router-view>
            </div>
        </section>
    </div>
@endsection
