@extends('dashboard.layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <h2>Users</h2>
        </div>

        <div class="table-responsive">
            <table class="table mt-4 table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Registered At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile" width="50" height="50" class="rounded-circle">
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role?->name ?? 'N/A' }}</td>
                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
