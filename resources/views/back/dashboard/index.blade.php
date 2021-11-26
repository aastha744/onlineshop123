@extends('layouts.back')

@section('title', 'Dashboard')

@section('nav')
    @include('back.templates.nav',['active'=> ''])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h1>
                        Dashboard
                    </h1>
                </div>
            </div>
        </div>
    </main>
@endsection
