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
                        @include('front.templates.nav', ['active' => 'profile'])
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-3">
                        <h4>Edit Profile</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mx-auto">
                        <form action="{{ route('front.user.profile.update') }}" method="post">
                            @method('PATCH')
                            @csrf
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name', $user->first_name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name', $user->middle_name) }}">
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name', $user->last_name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control-plaintext" value="{{ $user->email }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" id="address" class="form-control" required>{{ old('address', $user->address) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
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
