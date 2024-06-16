@extends('backend.layouts.master')
@section('title') {{'Edit User'}} @endsection
@section('page-header')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h3 class="h3 fw-bold mb-1">
                        Edit User
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
@section('content')
    @include('backend.partials.alert')

    <div class="block block-rounded">
        <div class="block-content block-content-full">
            <form action="{{ route('user.update', $user->id) }}" method="post">
                @method('PUT')
                @csrf
                <div class="mb-4">
                    <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="role-select">Role<span class="text-danger">*</span></label>
                    <select class="form-select" id="role-select" name="user_roles">
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ $role->id === $userRole->role_id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-alt-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
