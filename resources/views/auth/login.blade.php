@extends('layouts.front')

@section('title', 'Login')

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <div class="row">
            <div class="col-12 mt-3 text-center text-uppercase">
                <h2>Login</h2>
            </div>
        </div>

        <main class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
                <div class="row">
                    <div class="col-12">
                        <form action=" {{ url('/login') }} " method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" id="remember" class="form-check-input" value="yes">
                                    <label for="remember" class="form-check-label ml-2">Remember Me</label>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-auto"><button type="submit" class="btn btn-outline-dark">Login</button></div>
                                    <div class="col text-end"><a href="{{ route('password.request') }}">Forgot password?</a></div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
        <!-- Main Content -->
    </div>
@endsection
