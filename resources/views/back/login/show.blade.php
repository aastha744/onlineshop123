@extends('layouts.back')

@section('title', 'Login')

@section('content')
    <main class="row">
        <div class="col-3  bg-white my-3 mx-auto py-3">
            <div class="row">
                <div class="col text-center">
                    <h1>
                        Login
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('back.login.check') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" id="remember" class="form-check-input" value="yes">
                            <label for="remember" class="form-check-label">Remember Me</label>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
