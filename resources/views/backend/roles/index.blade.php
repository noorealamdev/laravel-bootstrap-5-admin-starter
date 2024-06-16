@extends('backend.layouts.master')
@section('title') {{ __('User Roles') }} @endsection
@section('page-header')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h3 class="h3 fw-bold mb-1">
                        User Roles
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
            <a class="block block-rounded block-link-shadow text-center" data-bs-toggle="modal" data-bs-target="#createRoleModal" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-success">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="fw-medium fs-sm text-success mb-0">
                        {{ __('Add Role') }}
                    </p>
                </div>
            </a>

            <!-- Add Role Modal -->
            <div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog"
                 aria-hidden="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ __('Add Role') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('roles.store') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label" for="name">Role Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="role_name">
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-alt-primary">Create Role</button>
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
            <h3 class="block-title">{{ __('User Roles') }}</h3>
        </div>
        <div class="block-content block-content-full overflow-x-auto">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Role Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td class="text-center fs-sm">{{ $role->id }}</td>
                        <td class="fs-sm">{{ $role->name }}</td>
                        <td class="fs-sm">
                            <div>
                                <a class="btn btn-sm btn-alt-primary" href="javascript:void(0)" data-bs-toggle="modal"
                                   data-bs-target="#editModal{{ $role->id }}" data-bs-original-title="Edit">
                                    <i class="fa fa-fw fa-pencil text-black"></i>
                                </a>
                                <a class="btn btn-sm btn-alt-danger mx-lg-2" href="javascript:void(0)" data-bs-toggle="modal"
                                   data-bs-target="#deleteModal{{ $role->id }}" data-bs-original-title="Delete">
                                    <i class="fa fa-fw fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editModal{{ $role->id }}" tabindex="-1" role="dialog"
                         aria-hidden="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('Edit Role') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('roles.update', $role->id) }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="mb-4">
                                            <label class="form-label" for="name">Role Name<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name" name="role_name" value="{{ $role->name }}">
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-alt-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal{{ $role->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="teamModalCenterTitle" aria-hidden="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('Delete Role') }}</h5>
                                </div>
                                <div class="modal-body text-center">
                                    <h5>Are you sure?</h5>
                                </div>
                                <div class="modal-footer">
                                    <form class="d-inline-block" action="{{ route('roles.destroy', $role->id) }}" method="POST">
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
