@extends('layouts.back')

@section('title', 'Edit User')

@section('nav')
    @include('back.templates.nav',['active' => 'users'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-6 mx-auto">
            <div class="row">
                <div class="col">
                    <h1>
                        Edit User
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('back.users.update', $user->id) }}" method="post">
                        @method('PATCH')
                        @csrf
                        <div class="mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name',$user->first_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" class="form-control" value="{{ old('middle_name',$user->middle_name) }}">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name',$user->last_name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control-plaintext" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" maxlength="30" value="{{ old('phone',$user->phone) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" required>{{ old('address',$user->address) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" {{ old('status', $user->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status', $user->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
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
