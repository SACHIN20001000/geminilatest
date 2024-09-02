<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="horizontal" data-nav-style="menu-click" data-menu-position="fixed" data-theme-mode="light">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Laravel Bootstrap Responsive Admin Web Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="laravel, framework laravel, laravel template, admin, laravel dashboard, template dashboard, admin dashboard ui, bootstrap dashboard, laravel framework, vite laravel, bootstrap 5 templates, laravel admin panel, laravel tailwind, admin panel, template admin, bootstrap admin panel.">

    <!-- TITLE -->
    <title> {{globalSetting()['title'] ?? 'Gemini Consultancy Services' }}</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ !empty(globalSetting()['fav_icon']) ? asset('setting/' . globalSetting()['fav_icon']) : asset('assets/img/brand/favicon.png') }}" type="image/x-icon">

    <!-- ICONS CSS -->
    <link href="{{asset('frontend/icons.css')}}" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link id="style" href="{{asset('frontend/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{asset('frontend/waves.min.css')}}" rel="stylesheet">

    <!-- SwiperJS Css -->
    <link rel="stylesheet" href="{{asset('frontend/swiper-bundle.min.css')}}">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('frontend/flatpickr.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/nano.min.css')}}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{asset('frontend/choices.min.css')}}">

    <script>
        if (localStorage.valexdarktheme) {
            document.querySelector("html").setAttribute("data-theme-mode", "dark")
        }
        if (localStorage.valexrtl) {
            document.querySelector("html").setAttribute("dir", "rtl")
            document.querySelector("#style")?.setAttribute("href", "{{asset('frontend/bootstrap.rtl.min.css')}}");
        }
    </script>
    <!-- APP CSS & APP SCSS -->
    <link rel="preload" as="style" href="{{asset('frontend/app-DBELQW1b.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/app-DBELQW1b.css')}}" />

    <style>
        .accordion.accordion-primary .accordion-button:after {
            color: #fff !important;
            background-image: none !important;
            content: "" !important;
            font-family: remixicon !important;
            transform: var(--bs-accordion-btn-icon-transform) !important;
        }
    </style>


</head>

<body class="landing-body">

    <div class="landing-page-wrapper">
      
        <header class="app-header">

    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element">
                <div class="horizontal-logo">
                    <a href="/" class="header-logo">
                        <img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" alt="logo" class="toggle-logo">
                        <img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" alt="logo" class="toggle-white">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link -->
                <a href="javascript:void(0);" class="sidemenu-toggle header-link" data-bs-toggle="sidebar">
                    <span class="open-toggle">
                      <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 width="24px" height="24px" viewBox="0 0 24.75 24.75" xml:space="preserve"
	>
<g>
	<path d="M0,3.875c0-1.104,0.896-2,2-2h20.75c1.104,0,2,0.896,2,2s-0.896,2-2,2H2C0.896,5.875,0,4.979,0,3.875z M22.75,10.375H2
		c-1.104,0-2,0.896-2,2c0,1.104,0.896,2,2,2h20.75c1.104,0,2-0.896,2-2C24.75,11.271,23.855,10.375,22.75,10.375z M22.75,18.875H2
		c-1.104,0-2,0.896-2,2s0.896,2,2,2h20.75c1.104,0,2-0.896,2-2S23.855,18.875,22.75,18.875z"/>
</g>
</svg>
                    </span>
                </a>
                <!-- End::header-link -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

            <!-- Start::header-element -->
            <div class="header-element align-items-center">
                <!-- Start::header-link|switcher-icon -->
                <div class="btn-list d-lg-none d-block">
                    <a href="/admin" class="btn btn-primary-light">
                        Sign In
                    </a>
                  
                </div>
                <!-- End::header-link|switcher-icon -->
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

    </header> <!-- End Main-Header -->

    <!-- Main-Sidebar -->
    <aside class="app-sidebar sticky" id="sidebar">

        <div class="container p-0">
            <!-- Start::main-sidebar -->
            <div class="main-sidebar">

                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills sub-open">
                    <div class="landing-logo-container">
                        <div class="horizontal-logo">
                            <a href="/" class="header-logo">
                                <img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" alt="logo" class="desktop-logo">
                                <img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" alt="logo" class="desktop-white">
                            </a>
                        </div>
                    </div>
                    <div class="slide-left" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg></div>
                    <ul class="main-menu">
                        <!-- Start::slide -->
                        <li class="slide">
                            <a class="side-menu__item" href="#home">
                                <span class="side-menu__label">Home</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide">
                            <a href="#features" class="side-menu__item">
                                <span class="side-menu__label">Features</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide">
                            <a href="#about" class="side-menu__item">
                                <span class="side-menu__label">About</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->

                        <!-- Start::slide -->
                        <li class="slide">
                            <a href="#faq" class="side-menu__item">
                                <span class="side-menu__label">Faq's</span>
                            </a>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide">
                            <a href="#contact" class="side-menu__item">
                                <span class="side-menu__label">Contact</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg></div>
                    <div class="d-lg-flex d-none">
                        <div class="btn-list d-lg-flex d-none mt-lg-2 mt-xl-0 mt-0">
                            <a href="/admin" class="btn btn-wave btn-primary">
                                Sign Up
                            </a>

                        </div>
                    </div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->
        </div>

    </aside> <!-- End Main-Sidebar -->

    <!-- Start::app-content -->
    <div class="main-content landing-main">


        <!-- Start:: Section-1 -->
        <div class="landing-banner" id="home">
            <section class="section">
                <div class="container main-banner-container">
                    <div class="row justify-content-center text-center">
                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-8">
                            <div class="py-5 pb-lg-0">
                                <div class="mb-3">
                                    <h5 class="fw-semibold text-fixed-white op-9">Manage Your Insurance Business</h5>
                                </div>
                                <p class="landing-banner-heading mb-3" style="font-size: 1.7rem;">Empowering Your Insurance Endeavors with Our Platform!</p>
                                <div class="fs-16 mb-5 text-fixed-white op-7"> Explore a comprehensive suite of tools designed to streamline your insurance operations.
                                    Our platform offers seamless policy management, efficient lead tracking, robust user management,
                                    and hassle-free payouts management. Experience the benefits of automation features that enhance
                                    the overall efficiency of your insurance processes..</div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- End:: Section-1 -->

        <!-- Start:: Section-2 -->
        <section class="section section-bg " id="features">
            <div class="container text-center position-relative">
                <p class="fs-12 fw-semibold text-success mb-1">
                    <span class="landing-section-heading">Features</span>
                </p>
                <div class="landing-title"></div>

                <div class="row  g-2 justify-content-center">
                    <div class="col-xl-12">
                        <div class="row justify-content-evenly">
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="card features main-features main-features-4 p-4 active" data-wow-delay="0.1s">
                                    <div class="bg-img mb-2">
                                        <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
                                            <circle cx="64" cy="64" r="64" fill="#42A3DB"></circle>
                                            <path fill="#347CBE" d="M85.5 26.6 66.1 61 33.3 98.6 62.6 128H64c33.7 0 61.3-26 63.8-59.1L85.5 26.6z"></path>
                                            <path fill="#CD2F30" d="M73.1 57.7h-16c3.6 18.7 11.1 36.6 22.1 52.5.3-5 1-9.8 1.8-14.5 4.6 1.3 9.2 2.3 13.7 3-9.7-12.2-17-26.1-21.6-41z"></path>
                                            <path fill="#F04D45" d="M54.9 57.7c-4.6 15-11.9 28.9-21.6 40.9 4.5-.7 9.1-1.7 13.7-3 .9 4.7 1.5 9.5 1.8 14.5 11-15.9 18.4-33.8 22.1-52.5h-16z">
                                            </path>
                                            <path fill="#FFF" d="M93.5 52c1.8-1.8 1.8-4.7 0-6.5-1.3-1.3-1.7-3.3-1-5 1-2.4-.1-5-2.5-6-1.7-.7-2.8-2.4-2.8-4.3 0-2.5-2.1-4.6-4.6-4.6-1.9 0-3.5-1.1-4.3-2.8-1-2.4-3.7-3.5-6-2.5-1.7.7-3.7.3-5-1-1.8-1.8-4.7-1.8-6.5 0-1.3 1.3-3.3 1.7-5 1-2.4-1-5 .1-6 2.5-.7 1.7-2.4 2.8-4.3 2.8-2.5 0-4.6 2.1-4.6 4.6 0 1.9-1.1 3.5-2.8 4.3-2.4 1-3.5 3.7-2.5 6 .7 1.7.3 3.7-1 5-1.8 1.8-1.8 4.7 0 6.5 1.3 1.3 1.7 3.3 1 5-1 2.4.1 5 2.5 6 1.7.7 2.8 2.4 2.8 4.3 0 2.5 2.1 4.6 4.6 4.6 1.9 0 3.5 1.1 4.3 2.8 1 2.4 3.7 3.5 6 2.5 1.7-.7 3.7-.3 5 1 1.8 1.8 4.7 1.8 6.5 0 1.3-1.3 3.3-1.7 5-1 2.4 1 5-.1 6-2.5.7-1.7 2.4-2.8 4.3-2.8 2.5 0 4.6-2.1 4.6-4.6 0-1.9 1.1-3.5 2.8-4.3 2.4-1 3.5-3.7 2.5-6-.7-1.7-.3-3.7 1-5z"></path>
                                            <path fill="#FFCD0A" d="M64 70.8c-12.2 0-22.1-9.9-22.1-22.1 0-12.2 9.9-22.1 22.1-22.1 12.2 0 22.1 9.9 22.1 22.1 0 12.2-9.9 22.1-22.1 22.1z"></path>
                                            <path fill="#FFF" d="M59.9 61c-.6 0-1.1-.2-1.5-.7l-8.3-9.2c-.7-.8-.7-2.1.1-2.8.8-.7 2.1-.7 2.8.1l6.7 7.5 15.1-18.8c.7-.9 2-1 2.8-.3.9.7 1 2 .3 2.8L61.4 60.2c-.3.5-.9.8-1.5.8z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">Insurance Management </h5>
                                        <p class="mb-0">Explore the powerful features of our insurance management platform designed to streamline your business operations. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="card features main-features main-features-2 wow p-4">
                                    <div class="bg-img mb-2">
                                        <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 128 128" viewBox="0 0 128 128">
                                            <circle cx="64" cy="64" r="63.5" fill="#54C0EB"></circle>
                                            <path fill="#84DBFF" d="M19.2,109c11.5,11.4,27.3,18.5,44.8,18.5c17.5,0,33.3-7.1,44.8-18.5H19.2z"></path>
                                            <rect width="19.6" height="10.4" x="54.2" y="92.7" fill="#FFF"></rect>
                                            <rect width="19.6" height="2.3" x="54.2" y="92.7" fill="#E6E9EE"></rect>
                                            <path fill="#E6E9EE" d="M82.2,109H45.8l0,0c0-3.3,2.7-6,6-6h24.4C79.5,103.1,82.2,105.7,82.2,109L82.2,109z"></path>
                                            <path fill="#324A5E" d="M103,92.7H25c-2.4,0-4.4-2-4.4-4.4V34.7c0-2.4,2-4.4,4.4-4.4h78c2.4,0,4.4,2,4.4,4.4v53.7   C107.4,90.7,105.4,92.7,103,92.7z"></path>
                                            <path fill="#FFF" d="M20.6,84v4.4c0,2.4,1.9,4.3,4.3,4.3H103c2.4,0,4.3-1.9,4.3-4.3V84H20.6z"></path>
                                            <rect width="80.3" height="46.9" x="23.9" y="33.4" fill="#FFF"></rect>
                                            <circle cx="100.3" cy="88.3" r="2" fill="#FF7058"></circle>
                                            <circle cx="94.7" cy="88.3" r="2" fill="#4CDBC4"></circle>
                                            <circle cx="89.1" cy="88.3" r="2" fill="#54C0EB"></circle>
                                            <rect width="9.7" height="27.7" x="32.3" y="46.7" fill="#ACB3BA"></rect>
                                            <rect width="9.7" height="15.8" x="45.7" y="58.7" fill="#4CDBC4"></rect>
                                            <rect width="9.7" height="23.1" x="59.1" y="51.3" fill="#FFD05B"></rect>
                                            <rect width="9.7" height="35.7" x="72.6" y="38.7" fill="#84DBFF"></rect>
                                            <rect width="9.7" height="8.1" x="86" y="66.3" fill="#FF7058"></rect>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">Policy Management</h5>
                                        <p class="mb-0"> Effortlessly manage insurance policies with our clean and well-structured platform, ensuring accurate and organized policy information.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="card features main-features main-features-3 wow p-4">
                                    <div class="bg-img mb-2">
                                        <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 128 128" viewBox="0 0 128 128">
                                            <circle cx="64" cy="64" r="63.5" fill="#54C0EB"></circle>
                                            <path fill="#FFF" d="M42.2,96H23.6c-1.6,0-2.8-1.3-2.8-2.8V34.8c0-1.6,1.3-2.8,2.8-2.8h18.6c1.6,0,2.8,1.3,2.8,2.8v58.3   C45.1,94.7,43.8,96,42.2,96z"></path>
                                            <rect width="18.7" height="36.8" x="23.6" y="35.8" fill="#4CDBC4"></rect>
                                            <circle cx="32.9" cy="83.9" r="7.2" fill="#E6E9EE"></circle>
                                            <circle cx="32.9" cy="83.9" r="5" fill="#324A5E"></circle>
                                            <path fill="#FFF" d="M68.8,96H50.2c-1.6,0-2.8-1.3-2.8-2.8V34.8c0-1.6,1.3-2.8,2.8-2.8h18.6c1.6,0,2.8,1.3,2.8,2.8v58.3   C71.6,94.7,70.4,96,68.8,96z"></path>
                                            <rect width="18.7" height="36.8" x="50.1" y="35.8" fill="#FF7058"></rect>
                                            <circle cx="59.5" cy="83.9" r="7.2" fill="#E6E9EE"></circle>
                                            <circle cx="59.5" cy="83.9" r="5" fill="#324A5E"></circle>
                                            <path fill="#FFF" d="M109,92.7l-18,4.6c-1.5,0.4-3.1-0.5-3.5-2.1L73.2,38.7c-0.4-1.5,0.5-3.1,2.1-3.5l18-4.6   c1.5-0.4,3.1,0.5,3.5,2.1l14.3,56.5C111.5,90.8,110.6,92.4,109,92.7z"></path>
                                            <rect width="18.7" height="36.8" x="80.4" y="36.1" fill="#FFD05B" transform="rotate(-14.193 89.778 54.551)"></rect>
                                            <circle cx="97" cy="83.2" r="7.2" fill="#E6E9EE"></circle>
                                            <circle cx="97" cy="83.2" r="5" fill="#324A5E"></circle>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">Lead Management</h5>
                                        <p class="mb-0"> Efficiently track and manage leads to enhance your customer acquisition process and boost your sales efforts. </p>
                                        <p class="mb-0"> &nbsp; </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="card features main-features main-features-4 wow fadeInUp reveal revealleft p-4">
                                    <div class="bg-img mb-2">
                                        <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 128 128" viewBox="0 0 128 128">
                                            <circle cx="64" cy="64" r="63.5" fill="#FFD05B"></circle>
                                            <path fill="#FFF" d="M30,103.8l0-79.7c0-1.8,1.5-3.3,3.3-3.3h50.1l0,11.4c0,1.8,1.5,3.3,3.3,3.3H98l0,68.3   c0,1.8-1.5,3.3-3.3,3.3H33.3C31.5,107.1,30,105.6,30,103.8z"></path>
                                            <path fill="#E6E9EE" d="M83.3,20.9h11.4c1.8,0,3.3,1.5,3.3,3.3l0,11.4H86.6c-1.8,0-3.3-1.5-3.3-3.3L83.3,20.9z"></path>
                                            <path fill="#CED5E0" d="M83.3,20.9h11.4c1.8,0,3.3,1.5,3.3,3.3l0,11.4L83.3,20.9z"></path>
                                            <rect width="54.6" height="2.4" x="36.7" y="50.7" fill="#E6E9EE"></rect>
                                            <rect width="54.6" height="2.4" x="36.7" y="58.2" fill="#E6E9EE"></rect>
                                            <rect width="54.6" height="2.4" x="36.7" y="65.8" fill="#E6E9EE"></rect>
                                            <rect width="54.6" height="2.4" x="36.7" y="73.4" fill="#E6E9EE"></rect>
                                            <rect width="23.5" height="2.4" x="67.8" y="80.9" fill="#84DBFF"></rect>
                                            <rect width="23.5" height="2.4" x="67.8" y="88.5" fill="#84DBFF"></rect>
                                            <rect width="54.6" height="2.4" x="36.7" y="43.1" fill="#E6E9EE"></rect>
                                            <rect width="29.6" height="2.4" x="36.7" y="35.6" fill="#84DBFF"></rect>
                                            <path fill="#FF7058" d="M41.1,83.3c-4.4,4.4-4.4,11.5,0,15.9s11.5,4.4,15.9,0c4.4-4.4,4.4-11.5,0-15.9   C52.6,78.9,45.5,78.9,41.1,83.3z M41.9,84.1c3.4-3.4,8.7-3.8,12.6-1.3l-1.6,1.6c-3-1.7-6.9-1.3-9.5,1.2c-2.6,2.6-3,6.5-1.2,9.5   l-1.6,1.6C38.1,92.8,38.5,87.5,41.9,84.1z M43.1,94.3c-1.3-2.5-0.9-5.7,1.2-7.7c2.1-2.1,5.2-2.5,7.7-1.2L43.1,94.3z M54.9,88.2   c1.3,2.5,0.9,5.7-1.2,7.7c-2.1,2.1-5.2,2.5-7.7,1.2L54.9,88.2z M56.1,98.3c-3.4,3.4-8.7,3.8-12.6,1.3l1.6-1.6   c3,1.7,6.9,1.3,9.5-1.2c2.6-2.6,3-6.5,1.2-9.5l1.6-1.6C60,89.6,59.5,94.9,56.1,98.3z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold">User Management</h5>
                                        <p class="mb-0"> Streamline user administration and access control with our comprehensive user management features. </p>
                                        <p class="mb-0"> &nbsp; </p>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- End:: Section-2 -->



        <!-- Start:: Section-4 -->
        <section class="section " id="about">
            <div class="container text-center">
                <p class="fs-12 fw-semibold text-success mb-1"><span class="landing-section-heading">Our Mission</span>
                </p>
                <div class="landing-title"></div>
                <h3 class="fw-semibold mb-2"> Ensuring Security and Peace of Mind. </h3>
                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <p class="text-muted fs-15 mb-3 fw-normal">We specialize in providing
                            comprehensive insurance management solutions.</p>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center mx-0">
                    <div class="col-xxl-4 col-xl-5 col-lg-5 text-center text-lg-start">
                        <img src="{{asset('frontend/9.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="col-xxl-8 col-xl-7 col-lg-7 pt-5 pb-0 px-lg-2 px-5 text-start">
                        <h4 class="text-lg-start fw-medium mb-4">Why Choose Us?</h4>
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="d-flex mb-2">
                                    <span>
                                        <i class='bx bxs-badge-check text-primary fs-18'></i>
                                    </span>
                                    <div class="ms-2">
                                        <h6 class="fw-medium mb-0">Customer Satisfaction </h6>
                                        <p class=" text-muted mb-3"> Our commitment is to ensure the satisfaction of our customers by
                                            delivering reliable and efficient insurance services. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="d-flex mb-2">
                                    <span>
                                        <i class='bx bxs-badge-check text-primary fs-18'></i>
                                    </span>
                                    <div class="ms-2">
                                        <h6 class="fw-medium mb-0">Tailored Coverage</h6>
                                        <p class=" text-muted mb-3"> Our insurance plans are designed to meet your specific needs,
                                            providing the right coverage for your peace of mind. </p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12 col-md-12">
                                    <div class="d-flex mb-2">
                                        <span>
                                            <i class='bx bxs-badge-check text-primary fs-18'></i>
                                        </span>
                                        <div class="ms-2">
                                            <h6 class="fw-medium mb-0">Switch Easily From One Color to Another Color style</h6>
                                            <p class=" text-muted">lorem ipsum, dolor sit var ameto condesetrat aiatel varen or damsenlel verman code Lorem ipsum, dolor sit amet consectetur </p>
                                        </div>
                                    </div>
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End:: Section-4 -->

        <!-- Start:: Section-5 -->
        <section class="section section-bg " id="statistics">
            <div class="container text-center">
                <p class="fs-12 fw-semibold text-success mb-1"><span class="landing-section-heading">Statistics</span>
                </p>
                <div class="landing-title"></div>
                <h3 class="fw-semibold mb-2">Our Achievements</h3>
                <div class="row justify-content-center mb-5">
                    <div class="col-xl-7">
                        <p class="text-muted fs-15mb-0 fw-normal">We take pride in our accomplishments and the milestones we have achieved over the years.</p>
                    </div>
                </div>
                <div class="row  g-2 justify-content-center">
                    <div class="col-xl-12">
                        <div class="row justify-content-evenly">
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="p-3 text-center rounded-2 bg-white border">
                                    <span class="mb-3 avatar avatar-lg rounded-2 bg-primary-transparent">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                                            <rect x="3" y="3" width="7" height="7"></rect>
                                            <rect x="14" y="3" width="7" height="7"></rect>
                                            <rect x="14" y="14" width="7" height="7"></rect>
                                            <rect x="3" y="14" width="7" height="7"></rect>
                                        </svg>
                                    </span>
                                    <h3 class="fw-semibold mb-0 text-dark">120+</h3>
                                    <p class="mb-1 fs-14 op-7 text-muted ">
                                        Lead Management
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="p-3 text-center rounded-2 bg-white border">
                                    <span class="mb-3 avatar avatar-lg rounded-2 bg-primary-transparent">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <line x1="20" y1="8" x2="20" y2="14"></line>
                                            <line x1="23" y1="11" x2="17" y2="11"></line>
                                        </svg>
                                    </span>
                                    <h3 class="fw-semibold mb-0 text-dark">60+</h3>
                                    <p class="mb-1 fs-14 op-7 text-muted ">
                                        Renewals
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="p-3 text-center rounded-2 bg-white border">
                                    <span class="mb-3 avatar avatar-lg rounded-2 bg-primary-transparent">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive">
                                            <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                            <rect x="1" y="3" width="22" height="5"></rect>
                                            <line x1="10" y1="12" x2="14" y2="12"></line>
                                        </svg> </span>
                                    <h3 class="fw-semibold mb-0 text-dark">10+</h3>
                                    <p class="mb-1 fs-14 op-7 text-muted ">
                                        Policy Management
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                                <div class="p-3 text-center rounded-2 bg-white border">
                                    <span class="mb-3 avatar avatar-lg rounded-2 bg-primary-transparent">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg> </span>
                                    <h3 class="fw-semibold mb-0 text-dark">30+</h3>
                                    <p class="mb-1 fs-14 op-7 text-muted ">
                                        Payout management
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- End:: Section-5 -->




        <!-- Start:: Section-8 -->
        <section class="section" id="faq">
            <div class="container text-center">
                <p class="fs-12 fw-semibold text-success mb-1"><span class="landing-section-heading">F.A.Q</span>
                </p>
                <div class="landing-title"></div>
                <h3 class="fw-semibold mb-2">Frequently asked questions ?</h3>
                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <p class="text-muted fs-15 mb-5 fw-normal">We have shared some of the most frequently asked questions to help you out.</p>
                    </div>
                </div>
                <div class="row text-start">
                    <div class="col-xl-12">
                        <div class="row gy-2">
                            <div class="col-xl-12">
                                <div class="accordion accordion-customicon1 accordion-primary accordions-items-seperate" id="accordionFAQ1">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingcustomicon1One">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapsecustomicon1One" aria-expanded="true"
                                                aria-controls="collapsecustomicon1One">
                                                Can I get a free trial before purchase?
                                            </button>
                                        </h2>
                                        <div id="collapsecustomicon1One" class="accordion-collapse collapse show"
                                            aria-labelledby="headingcustomicon1One"
                                            data-bs-parent="#accordionFAQ1">
                                            <div class="accordion-body">
                                                Yes, we offer a free trial of our Insurance Management system. You can explore its features and functionalities before making a purchase.


                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingcustomicon1Two">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapsecustomicon1Two"
                                                aria-expanded="false" aria-controls="collapsecustomicon1Two">
                                                What type of files will I get after purchase?
                                            </button>
                                        </h2>
                                        <div id="collapsecustomicon1Two" class="accordion-collapse collapse"
                                            aria-labelledby="headingcustomicon1Two"
                                            data-bs-parent="#accordionFAQ1">
                                            <div class="accordion-body">
                                                After your purchase, you will receive a download link containing the Insurance Management system files. This includes documentation and necessary assets for easy setup.


                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingcustomicon1Three">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapsecustomicon1Three"
                                                aria-expanded="false" aria-controls="collapsecustomicon1Three">
                                                What is a single Application?
                                            </button>
                                        </h2>
                                        <div id="collapsecustomicon1Three" class="accordion-collapse collapse"
                                            aria-labelledby="headingcustomicon1Three"
                                            data-bs-parent="#accordionFAQ1">
                                            <div class="accordion-body">
                                                A single application refers to a standalone instance of our Insurance Management system, capable of managing insurance-related tasks and data independently.


                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingcustomicon1Four">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapsecustomicon1Four"
                                                aria-expanded="false" aria-controls="collapsecustomicon1Four">
                                                How to get future updates? </button>
                                        </h2>
                                        <div id="collapsecustomicon1Four" class="accordion-collapse collapse"
                                            aria-labelledby="headingcustomicon1Four"
                                            data-bs-parent="#accordionFAQ1">
                                            <div class="accordion-body">
                                                We provide regular updates to our Insurance Management system. You will receive notifications and instructions on how to update your system to the latest version.


                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingcustomicon1Five">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapsecustomicon1Five"
                                                aria-expanded="false" aria-controls="collapsecustomicon1Five">
                                                Do you provide support? </button>
                                        </h2>
                                        <div id="collapsecustomicon1Five" class="accordion-collapse collapse"
                                            aria-labelledby="headingcustomicon1Five"
                                            data-bs-parent="#accordionFAQ1">
                                            <div class="accordion-body">
                                                Yes, we offer support for our Insurance Management system. If you have any questions or issues, our support team is ready to assist you.


                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End:: Section-8 -->

        <!-- Start:: Section-9 -->
        <section class="section section-bg" id="contact">
            <div class="container text-center">
                <p class="fs-12 fw-semibold text-success mb-1"><span class="landing-section-heading">CONTACT US</span>
                </p>
                <div class="landing-title"></div>
                <h3 class="fw-semibold mb-2">Have any questions ? We would love to hear from you.</h3>
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <p class="text-muted fs-15 mb-5 fw-normal">You can contact us anytime regarding any queries or deals,dont hesitate to clear your doubts before trying our product.</p>
                    </div>
                </div>
                <div class="text-start row justify-content-between">
                    <div class="col-lg-4">
                        <div class="card shadow-none">
                            <div class="card-body px-5 py-4">
                                <div class="d-flex mb-3 mt-2">
                                    <div
                                        class="contact-icon border bg-primary-transparent m-0">
                                        <i
                                            class="fe fe-map-pin text-primary fs-17"></i>
                                    </div>
                                    <div class="ms-3 text-start">
                                        <h6 class="mb-1 fw-medium">Main Branch</h6>
                                        <p>601 Jubilee Walk Sector 70 Mohali 160070 Punjab
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div
                                        class="contact-icon border bg-danger-transparent">
                                        <i
                                            class="fe fe-mail text-danger fs-17"></i>
                                    </div>
                                    <div class="ms-3 text-start">
                                        <h6 class="mb-1 fw-medium">
                                            Email</h6>
                                        <p>geminiservices@outlook.com

                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div
                                        class="contact-icon border bg-success-transparent">
                                        <i
                                            class="fe fe-headphones text-success fs-17"></i>
                                    </div>
                                    <div class="ms-3 text-start">
                                        <h6 class="mb-1 fw-medium">
                                            Contact</h6>
                                        <p>+91 99151 10099

                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div
                                        class="contact-icon border bg-warning-transparent">
                                        <i
                                            class="fe fe-airplay text-warning fs-17"></i>
                                    </div>
                                    <div class="ms-3 text-start">
                                        <h6 class="mb-1 fw-medium">
                                            Working Hours</h6>
                                        <p class="mb-0">Mon - Sat: 9am - 6pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow-none">
                            <div class="card-body px-5 pt-4">
                                <div class="row mt-1">
                                    <div class="col-xl-6">
                                        <div class="form-group ">
                                            <label for="cusName" class="form-label">Name
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                id="cusName" placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group">
                                            <label for="cusEmail" class="form-label">Email
                                                <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"
                                                id="cusEmail"
                                                placeholder="Enter your email">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cusMessage" class="form-label">Message <span
                                            class="text-danger">*</span></label>
                                    <textarea rows="4" class="form-control" id="cusMessage"
                                        placeholder="Type your message here..."></textarea>
                                </div>
                                <div class="form-group mb-2 pt-1">
                                    <button class="btn btn-primary">Send Message</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End:: Section-9 -->


        <div class="text-center landing-main-footer py-3">
            <span class="text-muted fs-15"> Copyright © <span id="year"></span> <a
                    href="javascript:void(0);" class="text-primary fw-semibold"><u>Gemini Services</u></a>.
                All rights reserved.</span>
            </span>
        </div>


    </div>
    <!-- End::main-content -->

    </div>
    <!--app-content closed-->



    <!-- SCRIPTS -->
    <!-- Back To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ri-arrow-up-s-fill fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>

    <!-- Popper JS -->
    <script src="{{asset('frontend/popper.min.js')}}"></script>

    <!-- Bootstrap JS -->
    <script src="{{asset('frontend/bootstrap.bundle.min.js')}}"></script>

    <!-- Color Picker JS -->
    <script src="{{asset('frontend/pickr.es5.min.js')}}"></script>

    <!-- Choices JS -->
    <script src="{{asset('frontend/choices.min.js')}}"></script>

    <!-- Swiper JS -->
    <script src="{{asset('frontend/swiper-bundle.min.js')}}"></script>

    <!-- Defaultmenu JS -->
    <link rel="modulepreload" href="{{asset('frontend/defaultmenu-D7WuEzZK.js')}}" />
    <script type="module" src="{{asset('frontend/defaultmenu-D7WuEzZK.js')}}"></script>
    <!-- Internal Landing JS -->
    <link rel="modulepreload" href="{{asset('frontend/landing-CrHtr5S0.js')}}" />
    <script type="module" src="{{asset('frontend/landing-CrHtr5S0.js')}}"></script>
    <!-- Node Waves JS-->
    <script src="{{asset('frontend/waves.min.js')}}"></script>

    <!-- Sticky JS -->
    <script src="{{asset('frontend/sticky.js')}}"></script>


</body>

</html>