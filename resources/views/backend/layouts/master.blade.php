<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>@yield('title', 'OneUI - Bootstrap 5 Laravel Admin Starter')</title>

    <meta name="description" content="web elements resources">
    <meta name="author" content="noor-e-alam.com">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="web elements resources">
    <meta property="og:site_name" content="Codemela">
    <meta property="og:description" content="web elements resources">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('backend/assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/assets/media/favicons/apple-touch-icon-180x180.png') }}">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- OneUI framework -->
    <link rel="stylesheet" id="css-main" href="{{ asset('backend/assets/css/oneui.css') }}">

    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">

    <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
    <!-- <link rel="stylesheet" id="css-theme" href="assets/css/themes/amethyst.min.css"> -->

    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/custom.css') }}">

    @stack('style')
    <!-- END Stylesheets -->
</head>

<body>
<!-- Page Container -->
<!--
  Available classes for #page-container:

  GENERIC

    'remember-theme'                            Remembers active color theme and dark mode between pages using localStorage when set through
                                                - Theme helper buttons [data-toggle="theme"],
                                                - Layout helper buttons [data-toggle="layout" data-action="dark_mode_[on/off/toggle]"]
                                                - ..and/or One.layout('dark_mode_[on/off/toggle]')

  SIDEBAR & SIDE OVERLAY

    'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
    'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
    'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
    'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
    'sidebar-dark'                              Dark themed sidebar

    'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
    'side-overlay-o'                            Visible Side Overlay by default

    'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

    'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

  HEADER

    ''                                          Static Header if no class is added
    'page-header-fixed'                         Fixed Header

  HEADER STYLE

    ''                                          Light themed Header
    'page-header-dark'                          Dark themed Header

  MAIN CONTENT LAYOUT

    ''                                          Full width Main Content if no class is added
    'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
    'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

  DARK MODE

    'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
-->
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">

    <!-- Sidebar -->
    <!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
            If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
    -->
    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="content-header">
            <!-- Logo -->
            <a class="fw-semibold text-dual" href="{{ route('dashboard') }}">
            <span class="smini-visible">
              <i class="fa fa-circle-notch text-primary"></i>
            </span>
                <span class="smini-hide fs-5 tracking-wider">CodeMela</span>
            </a>
            <!-- END Logo -->

            <!-- Extra -->
            <div>
                <!-- Dark Mode -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle">
                    <i class="far fa-moon"></i>
                </button>
                <!-- END Dark Mode -->
            </div>
            <!-- END Extra -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="{{ route('dashboard') }}">
                            <i class="nav-main-link-icon si si-speedometer"></i>
                            <span class="nav-main-link-name">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="{{ route('item.index') }}">
                            <i class="nav-main-link-icon fa-solid fa-list"></i>
                            <span class="nav-main-link-name">{{ __('Items') }}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="{{ route('user.index') }}">
                            <i class="nav-main-link-icon fa-solid fa-user"></i>
                            <span class="nav-main-link-name">{{ __('Users') }}</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link active" href="{{ route('roles.index') }}">
                            <i class="nav-main-link-icon fa-solid fa-user"></i>
                            <span class="nav-main-link-name">{{ __('User Roles') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Sidebar -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="d-flex align-items-center">
                <!-- Notifications Dropdown -->
{{--                <div class="dropdown d-inline-block ms-2">--}}
{{--                    <button type="button" class="btn btn-sm btn-alt-secondary" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        <i class="fa fa-fw fa-bell"></i>--}}
{{--                        <span class="text-primary">•</span>--}}
{{--                    </button>--}}
{{--                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 border-0 fs-sm" aria-labelledby="page-header-notifications-dropdown">--}}
{{--                        <div class="p-2 bg-body-light border-bottom text-center rounded-top">--}}
{{--                            <h5 class="dropdown-header text-uppercase">Notifications</h5>--}}
{{--                        </div>--}}
{{--                        <ul class="nav-items mb-0">--}}
{{--                            <li>--}}
{{--                                <a class="text-dark d-flex py-2" href="javascript:void(0)">--}}
{{--                                    <div class="flex-shrink-0 me-2 ms-3">--}}
{{--                                        <i class="fa fa-fw fa-check-circle text-success"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="flex-grow-1 pe-2">--}}
{{--                                        <div class="fw-semibold">You have a new follower</div>--}}
{{--                                        <span class="fw-medium text-muted">15 min ago</span>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <div class="p-2 border-top text-center">--}}
{{--                            <a class="d-inline-block fw-medium" href="javascript:void(0)">--}}
{{--                                <i class="fa fa-fw fa-arrow-down me-1 opacity-50"></i> Load More..--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- END Notifications Dropdown -->

                <!-- User Dropdown -->
                <div class="dropdown d-inline-block ms-2">
                    <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="Header Avatar" style="width: 21px;">
                        <span class="d-none d-sm-inline-block ms-2">{{ Auth::user()->name }}</span>
                        <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0" aria-labelledby="page-header-user-dropdown">
                        <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                            <img class="img-avatar img-avatar48 img-avatar-thumb" src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt="">
                            <p class="mt-2 mb-0 fw-medium">{{ Auth::user()->name }}</p>
                            {{--<p class="mb-0 text-muted fs-sm fw-medium">Web Developer</p>--}}
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('profile.edit') }}">
                                <span class="fs-sm fw-medium">Profile</span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="fs-sm fw-medium">Log Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">

        @yield('page-header')

        <!-- Page Content -->
        <div class="content">

            @yield('content')

        </div>
        <!-- END Page Content -->
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-3">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                    Crafted with <i class="fa fa-heart text-danger"></i> by Noor E Alam
                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                    Codemela © <span data-toggle="year-copy" class="js-year-copy-enabled">2024</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Page Container -->

<!--
    OneUI JS

    Core libraries and functionality
    webpack is putting everything together at assets/_js/main/app.js
-->
<script src="{{ asset('backend/assets/js/oneui.app.min.js') }}"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('backend/assets/js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('backend/assets/js/pages/be_pages_dashboard.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/be_tables_datatables.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/custom.js') }}"></script>

@stack('script')

</body>
</html>
