@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<div class="container mt-4">
    <h1>Halaman Users</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Create</a>

    <form action="{{ route('admin.users') }}" method="GET" class="d-flex justify-content-between align-items-center mb-3">
        <input 
            type="text"
            name="search"
            value="{{ request('search') }}"
            class="form-control me-2"
            placeholder="Search username or email"
            style="max-width: 88%;"
        >
        <button class="btn btn-outline-secondary" type="submit" style="width: 10%;">
            Search
        </button>
    </form>

    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>

            @foreach($users as $user)
            <tr>
                <td>{{ $users->firstItem() + $loop->index }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
                        Edit Akun
                    </a>
                    <span class="text-muted mx-1">|</span>
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
</div>

@endsection
