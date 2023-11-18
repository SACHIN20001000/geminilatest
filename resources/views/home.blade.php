<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Valex - Larvel Admin Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin dashboard, admin dashboard laravel, admin panel template, blade template, blade template laravel, bootstrap template, dashboard laravel, laravel admin, laravel admin dashboard, laravel admin panel, laravel admin template, laravel bootstrap admin template, laravel bootstrap template, laravel template">

    <!-- FAVICON -->
    <link rel="icon" href="{{ !empty(globalSetting()['fav_icon']) ? asset('setting/' . globalSetting()['fav_icon']) : asset('assets/img/brand/favicon.png') }}" type="image/x-icon">

    <!-- TITLE -->
    <title> {{globalSetting()['title'] ?? 'Gemini Consultancy Services' }}</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="https://laravelui.spruko.com/valex/build/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICONS CSS -->
    <link href="https://laravelui.spruko.com/valex/build/assets/iconfonts/icons.css" rel="stylesheet">

    <!-- ANIMATE CSS -->
    <link href="https://laravelui.spruko.com/valex/build/assets/iconfonts/animate.css" rel="stylesheet">

    <!-- APP SCSS & APP CSS -->
    <link rel="preload" as="style" href="https://laravelui.spruko.com/valex/build/assets/app.373b329f.css" />
    <link rel="preload" as="style" href="https://laravelui.spruko.com/valex/build/assets/app.dc980a30.css" />
    <link rel="stylesheet" href="https://laravelui.spruko.com/valex/build/assets/app.373b329f.css" />
    <link rel="stylesheet" href="https://laravelui.spruko.com/valex/build/assets/app.dc980a30.css" />


</head>

<body class="main-body app sidebar-mini ltr landing-page horizontalmenu">

    <!-- SWITCHER -->
    <div class="switcher-wrapper">
        <div class="demo_changer">
            <div class="form_holder sidebar-right1">
                <div class="row">
                    <div class="predefined_styles">
                        <div class="swichermainleft text-center">

                        </div>
                        <div class="swichermainleft text-center">
                            <h4>LTR AND RTL VERSIONS</h4>
                            <div class="skin-body">
                                <div class="switch_section">
                                    <div class="switch-toggle d-flex mt-2">
                                        <span class="me-auto">LTR</span>
                                        <p class="onoffswitch2 my-0"><input type="radio" name="onoffswitch25" id="myonoffswitch54" class="onoffswitch2-checkbox" checked>
                                            <label for="myonoffswitch54" class="onoffswitch2-label"></label>
                                        </p>
                                    </div>
                                    <div class="switch-toggle d-flex mt-2">
                                        <span class="me-auto">RTL</span>
                                        <p class="onoffswitch2 my-0"><input type="radio" name="onoffswitch25" id="myonoffswitch55" class="onoffswitch2-checkbox">
                                            <label for="myonoffswitch55" class="onoffswitch2-label"></label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swichermainleft">
                            <h4>Theme Style</h4>
                            <div class="skin-body">
                                <div class="switch_section">
                                    <div class="switch-toggle d-flex">
                                        <span class="me-auto">Light Theme</span>
                                        <p class="onoffswitch2 my-0"><input type="radio" name="onoffswitch1" id="myonoffswitch1" class="onoffswitch2-checkbox" checked>
                                            <label for="myonoffswitch1" class="onoffswitch2-label"></label>
                                        </p>
                                    </div>
                                    <div class="switch-toggle d-flex mt-2">
                                        <span class="me-auto">Dark Theme</span>
                                        <p class="onoffswitch2 my-0"><input type="radio" name="onoffswitch1" id="myonoffswitch2" class="onoffswitch2-checkbox">
                                            <label for="myonoffswitch2" class="onoffswitch2-label"></label>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swichermainleft">
                            <h4>Reset All Styles</h4>
                            <div class="skin-body">
                                <div class="switch_section my-4">
                                    <button id="resetAll" class="btn btn-danger btn-block" type="button">Reset All
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- END SWITCHER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">
            <!-- MAIN-HEADER -->
            <div class="main-header side-header">
                <div class="main-container container-fluid">
                    <div class="main-header-left">
                        <a class="main-header-menu-icon" href="javascript:void(0)" id="mainSidebarToggle"><span></span></a>
                        <div class="hor-logo">
                            <a class="main-logo" href="/">
                                <img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
                                <img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="header-brand-img desktop-logo-dark" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="main-header-center">
                        <div class="responsive-logo">
                            <a href="/"><img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="mobile-logo" alt="logo"></a>
                            <a href="/"><img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="mobile-logo-dark" alt="logo"></a>
                        </div>
                    </div>
                    <div class="main-header-right">
                        <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                        </button><!-- Navresponsive closed -->
                        <div class="header-setting-icon bg-primary rounded-5  d-block d-lg-none">
                            <a class="nav-link icon demo-icon mx-0" href="javascript:void(0);">
                                <i class="fe fe-settings  fe-spin"></i>
                            </a>
                        </div>
                        <div class="navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                <div class="d-flex order-lg-2 ms-auto">
                                    <!-- SEARCH -->
                                    <div class="header-nav-right p-3">
                                        <a href="{{ url('admin/register') }}" class="btn ripple btn-min w-sm btn-outline-primary me-2" target="_blank">New User
                                        </a>
                                        <a href="{{ url('admin') }}" class="btn ripple btn-min w-sm btn-primary me-2" target="_blank">Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN-HEADER -->

            <!-- MAIN-SIDEBAR -->
            <div class="landing-top-header overflow-hidden">
                <div class="top sticky">
                    <div class="landing-app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                    <div class="landing-app-sidebar bg-transparent">
                        <div class="container">
                            <div class="row">
                                <div class="main-sidemenu navbar px-0">
                                    <a class="main-logo" href="/">
                                        <img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
                                        <img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="header-brand-img desktop-logo-dark" alt="logo">
                                    </a>
                                    <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                                        </svg></div>
                                    <ul class="side-menu">
                                        <li class="slide">
                                            <a class="side-menu__item active" data-bs-toggle="slide" href="#home"><span class="side-menu__label">Home</span></a>
                                        </li>
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#Features"><span class="side-menu__label">Features</span></a>
                                        </li>
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#About"><span class="side-menu__label">About</span></a>
                                        </li>
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#faqs-2"><span class="side-menu__label">Highlights</span></a>
                                        </li>
                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#sectionfaq"><span class="side-menu__label">Faq's</span></a>
                                        </li>

                                        <li class="slide">
                                            <a class="side-menu__item" data-bs-toggle="slide" href="#Contact"><span class="side-menu__label">Contact</span></a>
                                        </li>
                                    </ul>
                                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                                        </svg></div>
                                    <div class="header-nav-right d-none d-lg-block">
                                        <a href="{{ url('admin/register') }}" class="btn ripple btn-min w-sm btn-outline-info me-2" target="_blank">New User
                                        </a>
                                        <a href="{{ url('admin') }}" class="btn ripple btn-min w-sm btn-primary me-2" target="_blank">Login
                                        </a>
                                    </div>
                                    <div class="header-setting-icon bg-primary rounded-5 d-none d-lg-block">
                                        <a class="nav-link icon demo-icon mx-0" href="javascript:void(0);">
                                            <i class="fe fe-settings  fe-spin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="demo-screen-headline main-demo main-demo-1 spacing-top overflow-hidden reveal" id="home">
                    <div class="container px-sm-0">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 animation-zidex pos-relative">
                                <h4 class="fw-semibold mt-7">Manage Your Insurance Business</h4>
                                <h1 class="text-start fw-bold">Empowering Your Insurance Endeavors with Our Platform!</h1>
                                <h6 class="pb-3">
                                    Explore a comprehensive suite of tools designed to streamline your insurance operations.
                                    Our platform offers seamless policy management, efficient lead tracking, robust user management,
                                    and hassle-free payouts management. Experience the benefits of automation features that enhance
                                    the overall efficiency of your insurance processes.

                                </h6>
                            </div>
                            <div class="col-xl-6 col-lg-6 my-auto">
                                <img src="https://laravelui.spruko.com/valex/build/assets/img/pngs/14.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- END MAIN-SIDEBAR -->

            <!-- MAIN-CONTENT -->
            <div class="main-content mt-0 ms-0">
                <div class="side-app">

                    <!-- ROW OPEN -->
                    <div class="sptb section bg-white-2" id="Features">
                        <div class="container">
                            <div class="row">
                                <h4 class="text-center fw-semibold landing-card-header">Features</h4>
                                <span class="landing-title"></span>
                                <h2 class="fw-semibold text-center">Insurance Management Features</h2>
                                <p class="text-default mb-5 text-center">Explore the powerful features of our insurance management platform designed to streamline your business operations.</p>
                                <div class="row mt-7">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card features main-features main-features-4 wow fadeInUp reveal revealleft active p-4" data-wow-delay="0.1s">
                                            <div class="bg-img mb-2 text-left">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                                    <circle cx="64" cy="64" r="64" fill="#42A3DB" />
                                                    <path fill="#347CBE" d="M85.5 26.6 66.1 61 33.3 98.6 62.6 128H64c33.7 0 61.3-26 63.8-59.1L85.5 26.6z" />
                                                    <path fill="#CD2F30" d="M73.1 57.7h-16c3.6 18.7 11.1 36.6 22.1 52.5.3-5 1-9.8 1.8-14.5 4.6 1.3 9.2 2.3 13.7 3-9.7-12.2-17-26.1-21.6-41z" />
                                                    <path fill="#F04D45" d="M54.9 57.7c-4.6 15-11.9 28.9-21.6 40.9 4.5-.7 9.1-1.7 13.7-3 .9 4.7 1.5 9.5 1.8 14.5 11-15.9 18.4-33.8 22.1-52.5h-16z" />
                                                    <path fill="#FFF" d="M93.5 52c1.8-1.8 1.8-4.7 0-6.5-1.3-1.3-1.7-3.3-1-5 1-2.4-.1-5-2.5-6-1.7-.7-2.8-2.4-2.8-4.3 0-2.5-2.1-4.6-4.6-4.6-1.9 0-3.5-1.1-4.3-2.8-1-2.4-3.7-3.5-6-2.5-1.7.7-3.7.3-5-1-1.8-1.8-4.7-1.8-6.5 0-1.3 1.3-3.3 1.7-5 1-2.4-1-5 .1-6 2.5-.7 1.7-2.4 2.8-4.3 2.8-2.5 0-4.6 2.1-4.6 4.6 0 1.9-1.1 3.5-2.8 4.3-2.4 1-3.5 3.7-2.5 6 .7 1.7.3 3.7-1 5-1.8 1.8-1.8 4.7 0 6.5 1.3 1.3 1.7 3.3 1 5-1 2.4.1 5 2.5 6 1.7.7 2.8 2.4 2.8 4.3 0 2.5 2.1 4.6 4.6 4.6 1.9 0 3.5 1.1 4.3 2.8 1 2.4 3.7 3.5 6 2.5 1.7-.7 3.7-.3 5 1 1.8 1.8 4.7 1.8 6.5 0 1.3-1.3 3.3-1.7 5-1 2.4 1 5-.1 6-2.5.7-1.7 2.4-2.8 4.3-2.8 2.5 0 4.6-2.1 4.6-4.6 0-1.9 1.1-3.5 2.8-4.3 2.4-1 3.5-3.7 2.5-6-.7-1.7-.3-3.7 1-5z" />
                                                    <path fill="#FFCD0A" d="M64 70.8c-12.2 0-22.1-9.9-22.1-22.1 0-12.2 9.9-22.1 22.1-22.1 12.2 0 22.1 9.9 22.1 22.1 0 12.2-9.9 22.1-22.1 22.1z" />
                                                    <path fill="#FFF" d="M59.9 61c-.6 0-1.1-.2-1.5-.7l-8.3-9.2c-.7-.8-.7-2.1.1-2.8.8-.7 2.1-.7 2.8.1l6.7 7.5 15.1-18.8c.7-.9 2-1 2.8-.3.9.7 1 2 .3 2.8L61.4 60.2c-.3.5-.9.8-1.5.8z" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <h4 class="fw-bold">Policy Management</h4>
                                                <p class="mb-0">Effortlessly manage insurance policies with our clean and well-structured platform, ensuring accurate and organized policy information
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card features main-features main-features-2 wow fadeInUp reveal revealleft active p-4" data-wow-delay="0.1s">
                                            <div class="bg-img mb-2 text-left">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 128 128" viewBox="0 0 128 128">
                                                    <circle cx="64" cy="64" r="63.5" fill="#54C0EB" />
                                                    <path fill="#84DBFF" d="M19.2,109c11.5,11.4,27.3,18.5,44.8,18.5c17.5,0,33.3-7.1,44.8-18.5H19.2z" />
                                                    <rect width="19.6" height="10.4" x="54.2" y="92.7" fill="#FFF" />
                                                    <rect width="19.6" height="2.3" x="54.2" y="92.7" fill="#E6E9EE" />
                                                    <path fill="#E6E9EE" d="M82.2,109H45.8l0,0c0-3.3,2.7-6,6-6h24.4C79.5,103.1,82.2,105.7,82.2,109L82.2,109z" />
                                                    <path fill="#324A5E" d="M103,92.7H25c-2.4,0-4.4-2-4.4-4.4V34.7c0-2.4,2-4.4,4.4-4.4h78c2.4,0,4.4,2,4.4,4.4v53.7   C107.4,90.7,105.4,92.7,103,92.7z" />
                                                    <path fill="#FFF" d="M20.6,84v4.4c0,2.4,1.9,4.3,4.3,4.3H103c2.4,0,4.3-1.9,4.3-4.3V84H20.6z" />
                                                    <rect width="80.3" height="46.9" x="23.9" y="33.4" fill="#FFF" />
                                                    <circle cx="100.3" cy="88.3" r="2" fill="#FF7058" />
                                                    <circle cx="94.7" cy="88.3" r="2" fill="#4CDBC4" />
                                                    <circle cx="89.1" cy="88.3" r="2" fill="#54C0EB" />
                                                    <rect width="9.7" height="27.7" x="32.3" y="46.7" fill="#ACB3BA" />
                                                    <rect width="9.7" height="15.8" x="45.7" y="58.7" fill="#4CDBC4" />
                                                    <rect width="9.7" height="23.1" x="59.1" y="51.3" fill="#FFD05B" />
                                                    <rect width="9.7" height="35.7" x="72.6" y="38.7" fill="#84DBFF" />
                                                    <rect width="9.7" height="8.1" x="86" y="66.3" fill="#FF7058" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <h4 class="fw-bold">Lead Management</h4>
                                                <p class="mb-0">
                                                    Efficiently track and manage leads to enhance your customer acquisition process and boost your sales efforts.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card features main-features main-features-3 wow fadeInUp reveal revealleft active p-4" data-wow-delay="0.1s">
                                            <div class="bg-img mb-2 text-left">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 128 128" viewBox="0 0 128 128">
                                                    <circle cx="64" cy="64" r="63.5" fill="#54C0EB" />
                                                    <path fill="#FFF" d="M42.2,96H23.6c-1.6,0-2.8-1.3-2.8-2.8V34.8c0-1.6,1.3-2.8,2.8-2.8h18.6c1.6,0,2.8,1.3,2.8,2.8v58.3   C45.1,94.7,43.8,96,42.2,96z" />
                                                    <rect width="18.7" height="36.8" x="23.6" y="35.8" fill="#4CDBC4" />
                                                    <circle cx="32.9" cy="83.9" r="7.2" fill="#E6E9EE" />
                                                    <circle cx="32.9" cy="83.9" r="5" fill="#324A5E" />
                                                    <path fill="#FFF" d="M68.8,96H50.2c-1.6,0-2.8-1.3-2.8-2.8V34.8c0-1.6,1.3-2.8,2.8-2.8h18.6c1.6,0,2.8,1.3,2.8,2.8v58.3   C71.6,94.7,70.4,96,68.8,96z" />
                                                    <rect width="18.7" height="36.8" x="50.1" y="35.8" fill="#FF7058" />
                                                    <circle cx="59.5" cy="83.9" r="7.2" fill="#E6E9EE" />
                                                    <circle cx="59.5" cy="83.9" r="5" fill="#324A5E" />
                                                    <path fill="#FFF" d="M109,92.7l-18,4.6c-1.5,0.4-3.1-0.5-3.5-2.1L73.2,38.7c-0.4-1.5,0.5-3.1,2.1-3.5l18-4.6   c1.5-0.4,3.1,0.5,3.5,2.1l14.3,56.5C111.5,90.8,110.6,92.4,109,92.7z" />
                                                    <rect width="18.7" height="36.8" x="80.4" y="36.1" fill="#FFD05B" transform="rotate(-14.193 89.778 54.551)" />
                                                    <circle cx="97" cy="83.2" r="7.2" fill="#E6E9EE" />
                                                    <circle cx="97" cy="83.2" r="5" fill="#324A5E" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <h4 class="fw-bold">User Management</h4>
                                                <p class="mb-0">
                                                    Streamline user administration and access control with our comprehensive user management features.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card features main-features main-features-4 wow fadeInUp reveal revealleft active p-4" data-wow-delay="0.1s">
                                            <div class="bg-img mb-2 text-left">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 128 128" viewBox="0 0 128 128">
                                                    <circle cx="64" cy="64" r="63.5" fill="#FFD05B" />
                                                    <path fill="#FFF" d="M30,103.8l0-79.7c0-1.8,1.5-3.3,3.3-3.3h50.1l0,11.4c0,1.8,1.5,3.3,3.3,3.3H98l0,68.3   c0,1.8-1.5,3.3-3.3,3.3H33.3C31.5,107.1,30,105.6,30,103.8z" />
                                                    <path fill="#E6E9EE" d="M83.3,20.9h11.4c1.8,0,3.3,1.5,3.3,3.3l0,11.4H86.6c-1.8,0-3.3-1.5-3.3-3.3L83.3,20.9z" />
                                                    <path fill="#CED5E0" d="M83.3,20.9h11.4c1.8,0,3.3,1.5,3.3,3.3l0,11.4L83.3,20.9z" />
                                                    <rect width="54.6" height="2.4" x="36.7" y="50.7" fill="#E6E9EE" />
                                                    <rect width="54.6" height="2.4" x="36.7" y="58.2" fill="#E6E9EE" />
                                                    <rect width="54.6" height="2.4" x="36.7" y="65.8" fill="#E6E9EE" />
                                                    <rect width="54.6" height="2.4" x="36.7" y="73.4" fill="#E6E9EE" />
                                                    <rect width="23.5" height="2.4" x="67.8" y="80.9" fill="#84DBFF" />
                                                    <rect width="23.5" height="2.4" x="67.8" y="88.5" fill="#84DBFF" />
                                                    <rect width="54.6" height="2.4" x="36.7" y="43.1" fill="#E6E9EE" />
                                                    <rect width="29.6" height="2.4" x="36.7" y="35.6" fill="#84DBFF" />
                                                    <path fill="#FF7058" d="M41.1,83.3c-4.4,4.4-4.4,11.5,0,15.9s11.5,4.4,15.9,0c4.4-4.4,4.4-11.5,0-15.9   C52.6,78.9,45.5,78.9,41.1,83.3z M41.9,84.1c3.4-3.4,8.7-3.8,12.6-1.3l-1.6,1.6c-3-1.7-6.9-1.3-9.5,1.2c-2.6,2.6-3,6.5-1.2,9.5   l-1.6,1.6C38.1,92.8,38.5,87.5,41.9,84.1z M43.1,94.3c-1.3-2.5-0.9-5.7,1.2-7.7c2.1-2.1,5.2-2.5,7.7-1.2L43.1,94.3z M54.9,88.2   c1.3,2.5,0.9,5.7-1.2,7.7c-2.1,2.1-5.2,2.5-7.7,1.2L54.9,88.2z M56.1,98.3c-3.4,3.4-8.7,3.8-12.6,1.3l1.6-1.6   c3,1.7,6.9,1.3,9.5-1.2c2.6-2.6,3-6.5,1.2-9.5l1.6-1.6C60,89.6,59.5,94.9,56.1,98.3z" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <h4 class="fw-bold">Payouts Management</h4>
                                                <p class="mb-0">
                                                    Efficiently handle and process payouts with our secure and automated payouts management system.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card features main-features main-features-5 wow fadeInUp reveal revealleft p-4" data-wow-delay="0.1s">
                                            <div class="bg-img mb-2 text-left">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 128 128" viewBox="0 0 128 128">
                                                    <circle cx="64" cy="64" r="63.5" fill="#90DFAA" />
                                                    <path fill="#FFF" d="M95.8,19.4H32.2c-1.9,0-3.4,1.5-3.4,3.4v82.5c0,1.9,1.5,3.4,3.4,3.4h63.7c1.9,0,3.4-1.5,3.4-3.4V22.7   C99.2,20.9,97.7,19.4,95.8,19.4z" />
                                                    <polygon fill="#324A5E" points="88.5 90.2 43 90.2 43 34.2 39.5 34.2 39.5 93.8 88.5 93.8" />
                                                    <rect width="4.9" height="44.8" x="48" y="41.3" fill="#FF7058" />
                                                    <rect width="4.9" height="38.3" x="58.1" y="47.8" fill="#84DBFF" />
                                                    <rect width="4.9" height="31.2" x="68.3" y="54.9" fill="#FFD05B" />
                                                    <rect width="4.9" height="22.7" x="78.4" y="63.3" fill="#CED5E0" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <h4 class="fw-bold">Claim Management</h4>
                                                <p class="mb-0">
                                                    Simplify the claims process and enhance customer satisfaction with our intuitive claim management system.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="card features main-features main-features-6 mb-4 wow fadeInUp reveal revealleft p-4" data-wow-delay="0.1s">
                                            <div class="bg-img mb-2 text-left">
                                                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 128 128" viewBox="0 0 128 128">
                                                    <circle cx="64" cy="64" r="63.5" fill="#54C0EB" />
                                                    <path fill="#FFF" d="M28.8,22.7v82.5c0,1.9,1.5,3.4,3.4,3.4H84V96.8c0-1.9,1.5-3.4,3.4-3.4h11.8V22.7c0-1.9-1.5-3.4-3.4-3.4   H32.2C30.3,19.4,28.8,20.9,28.8,22.7z" />
                                                    <path fill="#E6E9EE" d="M84,108.6h11.8c1.9,0,3.4-1.5,3.4-3.4V93.5H87.4c-1.9,0-3.4,1.5-3.4,3.4V108.6z" />
                                                    <path fill="#CED5E0" d="M84,108.6h11.8c1.9,0,3.4-1.5,3.4-3.4V93.5L84,108.6z" />
                                                    <rect width="6.3" height="11.8" x="47.6" y="39.6" fill="#CED5E0" />
                                                    <rect width="6.3" height="21.1" x="56.4" y="30.3" fill="#FFD05B" />
                                                    <rect width="6.3" height="17.1" x="65.3" y="34.2" fill="#84DBFF" />
                                                    <rect width="6.3" height="24.5" x="74.2" y="26.8" fill="#FF7058" />
                                                    <rect width="37.4" height="1.8" x="45.3" y="51.4" fill="#324A5E" />
                                                    <rect width="52.7" height="2.6" x="37.7" y="73.5" fill="#E6E9EE" />
                                                    <rect width="52.7" height="2.6" x="37.7" y="67.2" fill="#E6E9EE" />
                                                    <rect width="52.7" height="2.6" x="37.7" y="60.9" fill="#E6E9EE" />
                                                    <rect width="52.7" height="2.6" x="37.7" y="79.7" fill="#E6E9EE" />
                                                    <rect width="38" height="2.6" x="37.7" y="86" fill="#E6E9EE" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <h4 class="fw-bold">Reporting and Analytics</h4>
                                                <p class="mb-0">Gain valuable insights into your business performance with our advanced reporting and analytics tools.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW CLOSED -->



                    <!-- ROW OPEN -->
                    <div class="section bg-landing working-section  bg-white-2" id="About">
                        <div class="container">
                            <div class="row">
                                <h4 class="text-center fw-semibold landing-card-header">Insurance Management</h4>
                                <span class="landing-title"></span>
                                <div class="text-center">
                                    <h2 class="text-center fw-semibold">Ensuring Security and Peace of Mind.</h2>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card bg-transparent">
                                        <div class="card-body text-dark">
                                            <div class="statistics-info">
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 pe-0 my-auto">
                                                        <div class="ps-5">
                                                            <h2 class="text-start fw-semibold fs-25 mb-4">We specialize in providing
                                                                comprehensive insurance management solutions.</h2>
                                                            <div class="d-flex reveal revealleft">
                                                                <span><svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                                        <path fill="#0162e8" d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z" />
                                                                    </svg></span>
                                                                <div class="ms-4 mb-4">
                                                                    <h5 class="fw-bold">Tailored Coverage</h5>
                                                                    <p>Our insurance plans are designed to meet your specific needs,
                                                                        providing the right coverage for your peace of mind.</p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex reveal revealleft">
                                                                <span><svg style="width:20px;height:20px" viewBox="0 0 24 24">
                                                                        <path fill="#0162e8" d="M23,12L20.56,9.22L20.9,5.54L17.29,4.72L15.4,1.54L12,3L8.6,1.54L6.71,4.72L3.1,5.53L3.44,9.21L1,12L3.44,14.78L3.1,18.47L6.71,19.29L8.6,22.47L12,21L15.4,22.46L17.29,19.28L20.9,18.46L20.56,14.78L23,12M10,17L6,13L7.41,11.59L10,14.17L16.59,7.58L18,9L10,17Z" />
                                                                    </svg></span>
                                                                <div class="ms-4 mb-4">
                                                                    <h5 class="fw-bold">Customer Satisfaction</h5>
                                                                    <p>Our commitment is to ensure the satisfaction of our customers by
                                                                        delivering reliable and efficient insurance services.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6">
                                                        <div class="text-center reveal revealleft mb-3">
                                                            <img src="https://laravelui.spruko.com/valex/build/assets/img/pngs/16.png" alt="Insurance Management" class="br-5">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW CLOSED -->


                    <!-- ROW OPEN -->
                    <div class="testimonial-owl-landing">
                        <div class="container">
                            <div class="row">
                                <div class="card bg-transparent mb-0">
                                    <div class="demo-screen-skin code-quality" id="dependencies">
                                        <div class="text-center p-0">
                                            <div class="row justify-content-center">
                                                <div class="row text-center services-statistics landing-statistics">
                                                    <div class="col-xl-12">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-xl-3 col-md-6 col-lg-3">
                                                                            <div class=" reveal">
                                                                                <div class="bg-transparent">
                                                                                    <div class="counter-status">
                                                                                        <div class="counter-icon">
                                                                                            <i class="fe fe-server"></i>
                                                                                        </div>
                                                                                        <div class="test-body text-center">
                                                                                            <h1 class=" mb-0">
                                                                                                <span class="counter fw-semibold counter">100</span>
                                                                                                <span class="">+</span>
                                                                                            </h1>
                                                                                            <div class="counter-text">
                                                                                                <h5 class="font-weight-normal mb-0">
                                                                                                    Lead Management </h5>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-3 col-md-6 col-lg-3">
                                                                            <div class=" reveal">
                                                                                <div class="bg-transparent">
                                                                                    <div class="counter-status">
                                                                                        <div class="counter-icon">
                                                                                            <i class="fe fe-life-buoy"></i>
                                                                                        </div>
                                                                                        <div class="test-body text-center">
                                                                                            <h1 class=" mb-0">
                                                                                                <span class="counter fw-semibold counter">60</span>
                                                                                                <span class="">+</span>
                                                                                            </h1>
                                                                                            <div class="counter-text">
                                                                                                <h5 class="font-weight-normal mb-0">
                                                                                                    Renewals</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-3 col-md-6 col-lg-3">
                                                                            <div class=" reveal">
                                                                                <div class="bg-transparent">
                                                                                    <div class="counter-status">
                                                                                        <div class="counter-icon">
                                                                                            <i class="fe fe-file"></i>
                                                                                        </div>
                                                                                        <div class="test-body text-center">
                                                                                            <h1 class=" mb-0">
                                                                                                <span class="counter fw-semibold counter">10</span>
                                                                                                <span class="">+</span>
                                                                                            </h1>
                                                                                            <div class="counter-text">
                                                                                                <h5 class="font-weight-normal mb-0">
                                                                                                    Policy Management</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-3 col-md-6 col-lg-3">
                                                                            <div class=" reveal">
                                                                                <div class="bg-transparent">
                                                                                    <div class="counter-status">
                                                                                        <div class="counter-icon">
                                                                                            <i class="fe fe-grid"></i>
                                                                                        </div>
                                                                                        <div class="test-body text-center">
                                                                                            <h1 class=" mb-0">
                                                                                                <span class="counter fw-semibold counter">30</span>
                                                                                                <span class="">+</span>
                                                                                            </h1>
                                                                                            <div class="counter-text">
                                                                                                <h5 class="font-weight-normal mb-0">
                                                                                                    Payout management</h5>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW CLOSED -->

                    <!-- ROW OPEN -->
                    <div class="section">
                        <div class="container">
                            <div class="row">
                                <section class="sptb demo-screen-demo faqs" id="faqs-2">
                                    <div class="container">
                                        <div class="row align-items-center">
                                            <h4 class="text-center fw-semibold">Highlights</h4>
                                            <span class="landing-title"></span>
                                            <h2 class="text-center fw-semibold">Insurance Management Highlights</h2>
                                            <div class="col-lg-12">
                                                <div class="row justify-content-center">
                                                    <p class="col-lg-9 text-default sub-text mb-7">
                                                        Our Insurance Management system brings forth a set of advanced features
                                                        tailored to meet the diverse needs of the insurance industry. Explore the
                                                        highlights of our cutting-edge solution.
                                                    </p>
                                                </div>
                                                <div class="row" id="grid">
                                                    <div class="col-md-6">
                                                        <div class="col-md-12 grid-item  p-0">
                                                            <div class="card card-collapsed bg-primary-transparent text-primary p-0 highlights  reveal revealleft">
                                                                <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                                    <a href="#" class="card-options-collapse  h5 font-weight-bold  text-primary card-title mb-0"><i class="fe fe-chevron-up me-3"></i>Seamless Policy Management </a>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <p>
                                                                        Our Insurance Management system provides a seamless policy
                                                                        management experience, allowing easy creation, modification, and
                                                                        tracking of policies.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 grid-item  p-0">
                                                            <div class="card card-collapsed bg-success-transparent p-0  highlights  reveal revealleft">
                                                                <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                                    <a href="#" class="card-options-collapse  h5 font-weight-bold card-title text-success mb-0"><i class="fe fe-chevron-up me-3"></i>Advanced Claim Processing</a>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <p class="mb-3">
                                                                        Experience advanced claim processing with our Insurance Management
                                                                        system, ensuring quick and efficient handling of insurance claims.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 grid-item  p-0">
                                                            <div class="card card-collapsed bg-warning-transparent p-0  reveal revealleft">
                                                                <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                                    <a href="#" class="card-options-collapse  h5 font-weight-bold text-warning card-title mb-0"><i class="fe fe-chevron-up me-3"></i>Customizable Reporting</a>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <p>
                                                                        Tailor your reporting with our Insurance Management system,
                                                                        providing customizable reports to analyze and optimize your
                                                                        operations.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="col-md-12 grid-item  p-0">
                                                            <div class="card card-collapsed bg-info-transparent p-0 reveal revealleft">
                                                                <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                                    <a href="#" class="card-options-collapse  h5 font-weight-bold text-info card-title mb-0"><i class="fe fe-chevron-up me-3"></i>Integrated Customer
                                                                        Communication </a>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <p class="mb-3">
                                                                        Enhance customer communication with integrated tools in our
                                                                        Insurance Management system, fostering better engagement and
                                                                        satisfaction.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 grid-item  p-0">
                                                            <div class="card card-collapsed bg-danger-transparent p-0 reveal revealleft">
                                                                <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                                    <a href="#" class="card-options-collapse  h5 font-weight-bold text-danger card-title mb-0"><i class="fe fe-chevron-up me-3"></i>Security and Compliance</a>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <p>
                                                                        Prioritize security and compliance with our Insurance Management
                                                                        system, ensuring the confidentiality and integrity of sensitive
                                                                        information.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 grid-item  p-0">
                                                            <div class="card card-collapsed bg-secondary-transparent p-0 reveal revealleft">
                                                                <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                                    <a href="#" class="card-options-collapse  h5 font-weight-bold text-secondary card-title mb-0"><i class="fe fe-chevron-up me-3"></i>User-Friendly Interface</a>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <p>
                                                                        Our Insurance Management system boasts a user-friendly interface,
                                                                        ensuring a smooth and intuitive experience for users across the
                                                                        platform.
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!-- ROW CLOSED -->



                    <!-- ROW OPEN -->
                    <div class="section" id="sectionfaq">
                        <div class="container">
                            <div class="row">
                                <h4 class="text-center fw-semibold landing-card-header">FAQ'S ?</h4>
                                <span class="landing-title"></span>
                                <h2 class="text-center fw-semibold">Frequently Asked Questions</h2>
                                <div class="row justify-content-center">
                                    <p class="col-xl-9 wow fadeInUp text-default sub-text mb-5" data-wow-delay="0s">
                                        Our Insurance Management system provides answers to common questions. Explore the FAQs
                                        to find the information you need.
                                    </p>
                                </div>
                                <section class="sptb demo-screen-demo faqs">
                                    <h2 class="d-none">FAQ'S</h2>
                                    <div class="row align-items-center">
                                        <div class="col-md-12 col-lg-6 reveal revealright">
                                            <img src="https://laravelui.spruko.com/valex/build/assets/img/pngs/15.png" alt="">
                                        </div>
                                        <div class="col-md-12 col-lg-6">
                                            <div class="col-md-12 grid-item  px-0">
                                                <div class="card card-collapsed border  p-0 reveal revealleft">
                                                    <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                        <a href="javascript:void(0);" class="card-options-collapse h5 fw-bold card-title mb-0  text-primary"><span class="me-3 fs-18 fw-bold">01.</span>Can I get a free trial before purchase?</a>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <p>
                                                            Yes, we offer a free trial of our Insurance Management system. You can
                                                            explore its features and functionalities before making a purchase.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 grid-item  px-0">
                                                <div class="card card-collapsed border p-0 reveal revealleft">
                                                    <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                        <a href="javascript:void(0);" class="card-options-collapse  h5 fw-bold card-title mb-0 text-success"><span class="me-3 fs-18 fw-bold">02.</span>What type of files will I get after
                                                            purchase?</a>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <p>
                                                            After your purchase, you will receive a download link containing the
                                                            Insurance Management system files. This includes documentation and
                                                            necessary assets for easy setup.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 grid-item  px-0">
                                                <div class="card card-collapsed border  p-0 reveal revealleft">
                                                    <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                        <a href="javascript:void(0);" class="card-options-collapse  h5 fw-bold card-title mb-0 text-secondary"><span class="me-3 fs-18 fw-bold">03.</span>What is a single Application?</a>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <p>
                                                            A single application refers to a standalone instance of our Insurance
                                                            Management system, capable of managing insurance-related tasks and
                                                            data independently.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 grid-item  px-0">
                                                <div class="card card-collapsed border p-0 reveal revealleft">
                                                    <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                        <a href="javascript:void(0);" class="card-options-collapse  h5 fw-bold card-title mb-0 text-warning"><span class="me-3 fs-18 fw-bold">04.</span>How to get future updates?</a>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <p>
                                                            We provide regular updates to our Insurance Management system. You will
                                                            receive notifications and instructions on how to update your system to
                                                            the latest version.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 grid-item  px-0">
                                                <div class="card card-collapsed border p-0 reveal revealleft">
                                                    <div class="card-header grid-link" data-bs-toggle="card-collapse">
                                                        <a href="javascript:void(0);" class="card-options-collapse  h5 fw-bold card-title mb-0 text-danger"><span class="me-3 fs-18 fw-bold">05.</span>Do you provide support?</a>
                                                    </div>
                                                    <div class="card-body pt-0">
                                                        <p>
                                                            Yes, we offer support for our Insurance Management system. If you have any
                                                            questions or issues, our support team is ready to assist you.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>

                    <!-- ROW CLOSED -->


                    <!-- ROW OPEN -->
                    <div class="section pb-0" id="Contact">
                        <div class="container">
                            <div class="">
                                <div class="card reveal p-5 mb-0 ">
                                    <h4 class="text-center fw-semibold landing-card-header ">Contact</h4>
                                    <span class="landing-title"></span>
                                    <h2 class="text-center fw-semibold mb-0 px-2">Get in Touch with <span class="text-primary">US.</span></h2>
                                    <div class="card-body text-dark">
                                        <div class="statistics-info">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-12">
                                                    <div class="mt-3">
                                                        <div class="text-dark">
                                                            <div class="services-statistics reveal my-5">
                                                                <div class="row text-center">
                                                                    <div class="col-xl-3 col-md-6 col-lg-6">
                                                                        <div class="card">
                                                                            <div class="card-body p-0">
                                                                                <div class="counter-status d-flex">
                                                                                    <div class="counter-icon border border-primary bg-primary-transparent m-0">
                                                                                        <i class="fe fe-map-pin text-primary fs-23"></i>
                                                                                    </div>
                                                                                    <div class="ms-3 text-start">
                                                                                        <h5 class="mb-1 fw-semibold">Main Branch</h5>
                                                                                        <p>601 Jubilee Walk Sector 70 Mohali 160070 Punjab </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-md-6 col-lg-6">
                                                                        <div class="card">
                                                                            <div class="card-body p-0">
                                                                                <div class="counter-status d-flex">
                                                                                    <div class="counter-icon border border-danger bg-danger-transparent">
                                                                                        <i class="fe fe-mail text-danger fs-23"></i>
                                                                                    </div>
                                                                                    <div class="ms-3 text-start">
                                                                                        <h5 class="mb-1 fw-semibold">
                                                                                            Email</h5>
                                                                                        <p>geminiservices@outlook.com</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-md-6 col-lg-6">
                                                                        <div class="card">
                                                                            <div class="card-body p-0">
                                                                                <div class="counter-status d-flex">
                                                                                    <div class="counter-icon border border-success bg-success-transparent">
                                                                                        <i class="fe fe-headphones text-success fs-23"></i>
                                                                                    </div>
                                                                                    <div class="ms-3 text-start">
                                                                                        <h5 class="mb-1 fw-semibold">
                                                                                            Contact</h5>
                                                                                        <p>+91 99151 10099 </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-md-6 col-lg-6">
                                                                        <div class="card">
                                                                            <div class="card-body p-0">
                                                                                <div class="counter-status d-flex">
                                                                                    <div class="counter-icon border border-warning bg-warning-transparent">
                                                                                        <i class="fe fe-airplay text-warning fs-23"></i>
                                                                                    </div>
                                                                                    <div class="ms-3 text-start">
                                                                                        <h5 class="mb-1 fw-semibold">
                                                                                            Working Hours</h5>
                                                                                        <p class="mb-0">Mon -
                                                                                            Sat: 9am - 6pm</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW CLOSED -->

                </div>
            </div>
            <!-- END MAIN-CONTENT -->
        </div>
        <!-- FOOTER -->
        <div class="demo-footer">
            <div class="container">
                <div class="row">
                    <div class="card mb-0 bg-transparent">
                        <div class="card-body p-0">

                            <footer class="main-footer px-0 text-center border-top-0 mt-5">
                                <div class="row ">
                                    <div class="col-md-12 col-sm-12">
                                        Copyright © <span id="year"></span> <a href="javascript:void(0)">Gemini Services</a>.
                                        Designed with <span class="fa fa-heart text-danger"></span> by <a href="https://sachinkumar.me/"> Sachin Kumar </a> All rights reserved.
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- END FOOTER -->

    </div>
    <!-- END PAGE-->


    <!-- SCRIPTS -->
    <!-- BACK TO TOP -->
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

    <!-- JQUERY MIN JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/jquery/jquery.min.js"></script>

    <!-- BOOTSTRAP BUNDLE JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- PERFECT-SCROLLBAR JS  -->
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>


    <!-- OWL-CAROUSEL JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/owl-carousel/owl.carousel.js"></script>

    <!-- COMPANY-SLIDER JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/landing/lib/company-slider/slider.js"></script>

    <!-- COUNTERS JS-->
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/counters/counterup.min.js"></script>
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/counters/waypoints.min.js"></script>
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/counters/counters-1.js"></script>

    <!--- TABS JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/tabs/jquery.multipurpose_tabcontent.js"></script>
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/tabs/tab-content.js"></script>

    <!-- STAR RATING JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/rating/jquery-rate-picker.js"></script>
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/rating/rating-picker.js"></script>

    <!-- STAR RATING-1 JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/ratings-2/jquery.star-rating.js"></script>
    <script src="https://laravelui.spruko.com/valex/build/assets/plugins/ratings-2/star-rating.js"></script>

    <!-- SIDEMENU JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/landing/js/sidemenu.js"></script>

    <!-- STICKY JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/sticky.js"></script>

    <!-- LANDING THEME COLOR JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/landing/js/themecolor.js"></script>

    <!-- SWITCHER JS -->
    <link rel="modulepreload" href="https://laravelui.spruko.com/valex/build/assets/switcher.88cd5d65.js" />
    <script type="module" src="https://laravelui.spruko.com/valex/build/assets/switcher.88cd5d65.js"></script>

    <!-- LANDING JS -->
    <script src="https://laravelui.spruko.com/valex/build/assets/landing/js/landing.js"></script>

    <!-- END SCRIPTS -->

</body>

</html>