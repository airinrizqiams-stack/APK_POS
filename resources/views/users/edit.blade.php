@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<h4>Edit User</h4>

<form action="{{ route('admin.users.update', $user->id) }}" method="post">
    @csrf
    @method('PUT') 
    
    @include('users._form')
</form>
@endsection
