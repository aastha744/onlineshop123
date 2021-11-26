@extends('layouts.back')

@section('title', 'Users')

@section('nav')
    @include('back.templates.nav',['active'=> 'users'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h1>
                        Users
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($users->isNotEmpty())
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->address }}</td>
                                        <td>
                                            <span class="badge rounded-pill bg-{{ $user->status == 'Active' ? 'success': 'danger' }}">{{ $user->status }}</span>
                                        </td>
                                        <td>{{ $user->created_at->toDayDateTimeString() }}</td>
                                        <td>{{ $user->updated_at->toDayDateTimeString() }}</td>
                                        <td>
                                            <form action="{{ route('back.users.destroy', $user->id) }}" method="post">
                                                @method(('DELETE'))
                                                @csrf
                                                <a href="{{ route('back.users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm me-2">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </a>
                                                <button type="submit" class="btn btn-outline-danger btn-sm delete-item"> <i class="fas fa-times me-2"></i>Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    @else
                        <h5 class="text-muted fst-italic">No user added yet.</h5>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
