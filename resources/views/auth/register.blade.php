@extends('layouts.front')

@section('title', 'Register')

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <div class="row">
            <div class="col-12 mt-3 text-center text-uppercase">
                <h2>Register</h2>
            </div>
        </div>

        <main class="row">
            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto bg-white py-3 mb-4">
                <div class="row">
                    <div class="col-12">
                        <form action="{{ url('/register') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" required>{{ old('address') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="agree" id="agree" class="form-check-input" value="yes" required>
                                    <label for="agree" class="form-check-label ml-2">I agree to Terms and Conditions</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-dark">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
        <!-- Main Content -->
    </div>
@endsection
