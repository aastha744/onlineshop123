@extends('layouts.back')

@section('title', 'Staffs')

@section('nav')
    @include('back.templates.nav',['active'=> 'staffs'])
@endsection

@section('content')
    <main class="row bg-white my-3 py-3">
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <h1>
                        Staffs
                    </h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('back.staffs.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-2"></i>Add Staff
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($staffs->isNotEmpty())
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
                                @foreach($staffs as $staff)
                                    <tr>
                                        <td>{{ $staff->full_name }}</td>
                                        <td>{{ $staff->email }}</td>
                                        <td>{{ $staff->phone }}</td>
                                        <td>{{ $staff->address }}</td>
                                        <td>
                                            <span class="badge rounded-pill bg-{{ $staff->status == 'Active' ? 'success': 'danger' }}">{{ $staff->status }}</span>
                                        </td>
                                        <td>{{ $staff->created_at->toDayDateTimeString() }}</td>
                                        <td>{{ $staff->updated_at->toDayDateTimeString() }}</td>
                                        <td>
                                            <form action="{{ route('back.staffs.destroy', $staff->id) }}" method="post">
                                                @method(('DELETE'))
                                                @csrf
                                                <a href="{{ route('back.staffs.edit', $staff->id) }}" class="btn btn-outline-primary btn-sm me-2">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </a>
                                                <button type="submit" class="btn btn-outline-danger btn-sm delete-item"> <i class="fas fa-times me-2"></i>Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $staffs->links() }}
                    @else
                        <h5 class="text-muted fst-italic">No staff added yet.</h5>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
