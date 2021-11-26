@extends('layouts.front')

@section('title', 'Reset Password')

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <div class="row">
            <div class="col-12 mt-3 text-center text-uppercase">
                <h2>Reset Password</h2>
            </div>
        </div>

        <main class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
                <div class="row">
                    <div class="col-12">
                        <form action=" {{ route('password.email') }} " method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-outline-dark">Send Password Reset Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
        <!-- Main Content -->
    </div>
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <form method="POST" action="{{ route('password.email') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Send Password Reset Link') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
