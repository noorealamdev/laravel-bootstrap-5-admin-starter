@php
    $generated_item_id = 'cm-id-' . $item->id;
@endphp
@extends('backend.layouts.master')
@section('title') {{'Edit Item'}} @endsection
@section('page-header')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h3 class="h3 fw-bold mb-1">
                        Edit Item #{{ $item->id }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
@section('content')
    @include('backend.partials.alert')

    <!-- Item edit css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/highlight-js-dracula-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/suggesttags/amsify.suggestags.css') }}">

    <!-- Item edit js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="{{ asset('backend/assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ asset('backend/assets/suggesttags/jquery.amsify.suggestags.js') }}"></script>

    <form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">HTML</h3>
                <div class="block-options">
                    <a href="{{ route('item.editor', $item->id) }}" class="btn btn-sm btn-dark">Edit HTML</a>
                </div>
            </div>
            <div class="block-content p-0 overflow-auto" style="height: 300px">
                <pre class="theme-atom-one-dark" style="margin-bottom: 0"><code class="language-html">{{ $item->html }}</code></pre>
            </div>
        </div>
{{--        <div class="block block-rounded">--}}
{{--            <div class="block-header block-header-default">--}}
{{--                <h3 class="block-title">Shopify 2.0</h3>--}}
{{--            </div>--}}
{{--            <div class="block-content p-0 overflow-auto" style="height: 300px">--}}
{{--                <pre class="theme-atom-one-dark" style="margin-bottom: 0"><code class="language-python">{{ $item->shopify }}</code></pre>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Item Options</h3>
            </div>
            <div class="block-content">
                <div class="mb-4">
                    @if(!empty($item->screenshot))
                        <img class="mt-2" src="{{ asset('uploads/screenshots/'. $item->screenshot) }}" alt="" width="600" height="300">
                    @endif
                </div>
                <div class="mb-4">
                    <label class="form-label" for="screenshot">Item screenshot</label>
                    <input class="form-control" type="file" id="screenshot" name="screenshot" value="{{ $item->screenshot }}" accept="image/png, image/jpeg">
                    <span class="text-muted">jpg/png image supported.</span>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="price">Price (USD)<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $item->price }}">
                    <span class="text-muted">Price 0 means free item.</span>
                    {{--<div class="invalid-feedback">Price is required</div>--}}
                </div>
                <div class="mb-4">
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" id="has_image" name="has_image" {{ $item->has_image == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="has_image">Item has image</label>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" {{ $item->is_featured == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">Featured item</label>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="form-check form-switch form-check-inline">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" {{ $item->is_active == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active item</label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="tags">Tags<span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ $item->tags }}">
                </div>

                <div class="mb-4 mt-6">
                    <button type="submit" class="btn btn-alt-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </form>


    <script>
        //HighlightJs init
        hljs.highlightAll();

        // Item tags jquery
        $('input[name="tags"]').amsifySuggestags({
            type : 'amsify',
            suggestions: ['Hero', 'Testimonial', 'Features', 'Call to Action', 'Footer']
        });

    </script>
@endsection
