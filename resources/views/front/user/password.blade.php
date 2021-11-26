@extends('layouts.front')

@section('title', 'User Dashboard')

@section('content')
    <div class="col-12">
        <!-- Main Content -->
        <div class="row">
            <div class="col-12 mt-3 text-center text-uppercase">
                <h2>User Dashboard</h2>
            </div>
        </div>

        <main class="row">
            <div class="col-sm-8 mx-auto bg-white py-3 mb-4">
                <div class="row">
                    <div class="col-12">
                        @include('front.templates.nav', ['active' => 'password'])
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-3">
                        <h4>Change Password</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mx-auto">
                        <form action="{{ route('front.user.password.update') }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="mb-3">
                                <label for="old_password" class="form-label">Old Password</label>
                                <input type="password" name="old_password" id="old_password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-dark">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </main>
        <!-- Main Content -->
    </div>
@endsection
