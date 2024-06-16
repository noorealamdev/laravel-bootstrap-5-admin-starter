@extends('backend.layouts.master')
@section('title') {{ __('All Items') }} @endsection
@section('page-header')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h3 class="h3 fw-bold mb-1">
                        All Items
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
            <a class="block block-rounded block-link-shadow text-center" data-bs-toggle="modal" data-bs-target="#confirmCreateItemModal" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="fs-2 fw-semibold text-success">
                        <i class="fa fa-plus"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="fw-medium fs-sm text-success mb-0">
                        {{ __('Add New') }}
                    </p>
                </div>
            </a>
            <!-- Modal -->
            <div class="modal fade" id="confirmCreateItemModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <h3>Are you sure!</h3>
                            <form action="{{ route('item.generateId') }}" method="post">
                                @csrf
                                <input class="btn btn-success" type="submit" value="Yes please!">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="col-6 col-lg-3">--}}
{{--            <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">--}}
{{--                <div class="block-content block-content-full">--}}
{{--                    <div class="fs-2 fw-semibold text-danger">24</div>--}}
{{--                </div>--}}
{{--                <div class="block-content py-2 bg-body-light">--}}
{{--                    <p class="fw-medium fs-sm text-danger mb-0">--}}
{{--                        Out of stock--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-6 col-lg-3">--}}
{{--            <a class="block block-rounded block-link-shadow text-center" href="be_pages_ecom_dashboard.html">--}}
{{--                <div class="block-content block-content-full">--}}
{{--                    <div class="fs-2 fw-semibold text-dark">260</div>--}}
{{--                </div>--}}
{{--                <div class="block-content py-2 bg-body-light">--}}
{{--                    <p class="fw-medium fs-sm text-muted mb-0">--}}
{{--                        New--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
{{--        <div class="col-6 col-lg-3">--}}
{{--            <a class="block block-rounded block-link-shadow text-center" href="be_pages_ecom_dashboard.html">--}}
{{--                <div class="block-content block-content-full">--}}
{{--                    <div class="fs-2 fw-semibold text-dark">14503</div>--}}
{{--                </div>--}}
{{--                <div class="block-content py-2 bg-body-light">--}}
{{--                    <p class="fw-medium fs-sm text-muted mb-0">--}}
{{--                        All Products--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>
    <!-- END Quick Overview -->

    <!-- Dynamic Table Full Pagination -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('All Items') }}</h3>
        </div>
        <div class="block-content block-content-full overflow-x-auto">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px;">ID</th>
                    <th>Price</th>
                    <th>Developer</th>
                    <th>Featured</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td class="text-center fs-sm">{{ $item->id }}</td>
                        @if($item->price === 0)
                            <td class="fs-sm">Free Item</td>
                        @else
                            <td class="fw-semibold fs-sm"><span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info text-white">{{ __('$') }}{{ $item->price }}</span></td>
                        @endif
                        <td class="fs-sm">{{ Auth::user()->name }}</td>
                        <td class="fw-semibold fs-sm">
                        @if($item->is_featured === 1)
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-gray text-black">{{ __('Featured') }}</span>
                        @endif
                        </td>
                        <td class="fw-semibold fs-sm">
                            @if($item->is_active === 1)
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success text-white">{{ __('Active') }}</span>
                            @else
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info text-white">{{ __('In Review') }}</span>
                            @endif
                        </td>
                        <td class="text-center fs-sm">{{ $item->views }}</td>
                        <td class="fs-sm">
                            <div>
                                <a class="btn btn-sm btn-alt-primary" href="{{ route('item.edit', $item->id) }}">
                                    <i class="fa fa-fw fa-pencil text-black"></i>
                                </a>
                                <a class="btn btn-sm btn-alt-danger mx-lg-2" href="javascript:void(0)" data-bs-toggle="modal"
                                   data-bs-target="#deleteModal{{ $item->id }}" data-bs-original-title="Delete">
                                    <i class="fa fa-fw fa-trash text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Delete -->
                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" role="dialog"
                         aria-labelledby="teamModalCenterTitle" aria-hidden="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ __('Delete Item') }}</h5>
                                </div>
                                <div class="modal-body text-center">
                                    <h5>Are you sure?</h5>
                                </div>
                                <div class="modal-footer">
                                    <form class="d-inline-block" action="{{ route('item.destroy', $item->id) }}" method="POST">
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
