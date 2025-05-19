@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>

    <div class="mt-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
            👤 Kelola User
        </a>
    </div>
</div>
@endsection