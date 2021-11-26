@extends('layouts.back')

@section('title', 'Change Password')

@section('nav')
    @include('back.templates.nav',['active' => 'profile'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-6 mx-auto">
            <div class="row">
                <div class="col">
                    <h1>
                        Change Password
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('back.password.update') }}" method="post">
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
                        <div class="mb-3">
                            <button type="submit" class="btn btn-outline-primary"><i class="fas fa-save me-2"></i>Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
