@extends('backend.layouts.master')
@section('title') {{ __('All Users') }} @endsection
@section('page-header')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h3 class="h3 fw-bold mb-1">
                        All Users
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
@section('content')
    @include('backend.partials.alert')
    <!-- Quick Overview -->
    <div class="row">
        <div class="col-6 col-lg-3">
            <a class="block block-rounded block-link-shadow text-center" data-bs-toggle="modal" data-bs-target="#createUserModal" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-success">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="fw-medium fs-sm text-success mb-0">
                        {{ __('Add User') }}
                    </p>
                </div>
            </a>

            <!-- Add User Modal -->
            <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog"
                 aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Add User') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.store') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label" for="name">Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="email">Email<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="password">Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label" for="user_roles">Role<span class="text-danger">*</span></label>
                                    <select class="form-select" id="user_roles" name="user_roles">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-alt-primary">Create User</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Quick Overview -->

    <!-- Dynamic Table Full Pagination -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('All User') }}</h3>
        </div>
        <div class="block-content block-content-full overflow-x-auto">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="text-center fs-sm">{{ $user->id }}</td>
                        <td class="fs-sm">{{ $user->name }}</td>
                        <td class="fs-sm">{{ $user->email }}</td>
                        <td class="fs-sm">{{ $user->roles[0]->name }}</td>
                        <td class="fs-sm">
                            <div>
                                <a class="btn btn-sm btn-alt-primary" href="{{ route('user.edit', $user->id) }}">
                                    <i class="fa fa-fw fa-pencil text-black"></i>
                                </a>
                                <a class="btn btn-sm btn-alt-danger mx-lg-2" href="javascript:void(0)" data-bs-toggle="modal"
                                   data-bs-target="#deleteModal{{ $user->id }}" data-bs-original-title="Delete">
                                    <i class="fa fa-fw fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="teamModalCenterTitle" aria-hidden="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('Delete User') }}</h5>
                                </div>
                                <div class="modal-body text-center">
                                    <h5>Are you sure?</h5>
                                </div>
                                <div class="modal-footer">
                                    <form class="d-inline-block" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel
                                        </button>
                                        <button type="submit" class="btn btn-success">Yes, delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full Pagination -->
@endsection
