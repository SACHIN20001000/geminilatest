<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />


        <!-- Title -->
        <title> Gemini Consultancy Services </title>

        <!-- Favicon -->
        <link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>

        <!-- Icons css -->
        <link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
            <!-- Internal  Quill css
        <link href="{{URL::asset('assets/plugins/quill/quill.snow.css')}}" rel="stylesheet">
        <link href="{{URL::asset('assets/plugins/quill/quill.bubble.css')}}" rel="stylesheet"> -->
        <!-- Bootstrap css -->
        <link href="{{URL::asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <!---Internal Fileupload css-->
        <link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css"/>

        <!---Internal Fancy uploader css-->
        <link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
        <!--  Owl-carousel css-->
        <link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
        <!-- Internal Select2 css -->
        <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
        <!-- P-scroll bar css-->
        <link href="{{URL::asset('assets/plugins/perfect-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />
		<!---Internal  Darggable css-->
		<link href="{{URL::asset('assets/plugins/darggable/jquery-ui-darggable.css')}}" rel="stylesheet">
        <!--  Right-sidemenu css -->
        <link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">

        <!-- Sidemenu css -->
        <link rel="stylesheet" href="{{URL::asset('assets/css/sidemenu.css')}}">
        <link rel="stylesheet" href="{{URL::asset('assets/css/daterange.css')}}">

        <!-- Maps css -->
        <link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">

        <!-- style css -->
        <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">
        <link href="{{URL::asset('assets/css/style-dark.css')}}')}}" rel="stylesheet">
        <link href="{{URL::asset('assets/css/boxed.css')}}" rel="stylesheet">
        <link href="{{URL::asset('assets/css/dark-boxed.css')}}" rel="stylesheet">

        <!---Skinmodes css-->
        <link href="{{URL::asset('assets/css/skin-modes.css')}}" rel="stylesheet" />
        <link href="{{ mix('css/admin.css') }}" rel="stylesheet" />

<style>
.hidden{display:none}
aside.app-sidebar.sidebar-scroll {overflow: scroll;}
</style>
    </head>

    <body class="main-body app sidebar-mini">

        <!-- Loader -->
        <!-- <div id="global-loader">
            <img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
        </div> -->
        <!-- /Loader -->
        <div class="page">

            @include('admin.layouts.navigation')
            <div class="main-content app-content">

                <!-- main-header -->
                <div class="main-header sticky side-header nav nav-item">
                    <div class="container-fluid">
                        <div class="main-header-left ">
                            <div class="responsive-logo">
                                <a href="index.html"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="logo-1"
                                                          alt="logo"></a>
                                <a href="index.html"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="dark-logo-1"
                                                          alt="logo"></a>
                                <a href="index.html"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-2"
                                                          alt="logo"></a>
                                <a href="index.html"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="dark-logo-2"
                                                          alt="logo"></a>
                            </div>
                            <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
                            </div>
                            <!-- <div class="main-header-center ms-3 d-sm-none d-md-none d-lg-block">
                                <input class="form-control" placeholder="Search for anything..." type="search"> <button
                                    class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
                            </div> -->
                        </div>
                        <div class="main-header-right">
                            <ul class="nav nav-item  navbar-nav-right ms-auto">

                                <li class="dropdown main-profile-menu nav nav-item nav-link">
                                    <a class="profile-user d-flex">
                                    @if(!empty(Auth::user()->profile))
                                    <img alt=""src="{{URL::asset('profile')}}/{{Auth::user()->profile}}">
                            @else
                            <img src="../../assets/img/faces/6.jpg"  alt="img">
                            @endif


                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="main-header-profile bg-primary p-3">
                                            <div class="d-flex wd-100p">
                                                <div class="main-img-user">
                                                @if(!empty(Auth::user()->profile))
                                                <img alt="" src="{{URL::asset('profile')}}/{{Auth::user()->profile}}" class="">
                                                    @else
                                                    <img src="../../assets/img/faces/6.jpg"  alt="img">
                                                    @endif


                                                                            </div>
                                                <div class="ms-3 my-auto">

                                                    <h6>{{ auth()->user()->name??'Petey Cruiser' }}</h6><span>Premium Member</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="{{route('viewProfile')}}"><i class="bx bx-user-circle"></i>Profile</a>
                                        <a class="dropdown-item" href="{{route('updateProfile')}}"><i class="bx bx-cog"></i> Edit Profile</a>
                                        <!-- <a class="dropdown-item" href=""><i class="bx bxs-inbox"></i>Inbox</a>
                                        <a class="dropdown-item" href=""><i class="bx bx-envelope"></i>Messages</a> -->
                                        <a class="dropdown-item" href="#"><i class="bx bx-slider-alt"></i> Account
                                            Settings</a>
                                    <!-- <a class="dropdown-item" href="signin.html"><i class="bx bx-log-out"></i> Sign
                                            Out</a> -->
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                            <i class="bx bx-log-out"></i> Sign Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>


                            </ul>
                        </div>
                    </div>
                </div>
                @include('flash-message')
                @yield('content')
            </div>
            <div class="modal fade" id="chatmodel" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-dialog-right chatbox" role="document">
                    <div class="modal-content chat border-0">
                        <div class="card overflow-hidden mb-0 border-0">
                            <!-- action-header -->
                            <div class="action-header clearfix">
                                <div class="float-start hidden-xs d-flex ms-2">
                                    <div class="img_cont me-3">
                                        <img src="{{Auth::user()->profile}}" class="rounded-circle user_img" alt="img">
                                    </div>
                                    <div class="align-items-center mt-2">
                                        <h4 class="text-white mb-0 fw-semibold">Daneil Scott</h4>
                                        <span class="dot-label bg-success"></span><span class="me-3 text-white">online</span>
                                    </div>
                                </div>
                                <ul class="ah-actions actions align-items-center">
                                    <li class="call-icon">
                                        <a href="" class="d-done d-md-block phone-button" data-bs-toggle="modal" data-bs-target="#audiomodal">
                                            <i class="si si-phone"></i>
                                        </a>
                                    </li>
                                    <li class="video-icon">
                                        <a href="" class="d-done d-md-block phone-button" data-bs-toggle="modal" data-bs-target="#videomodal">
                                            <i class="si si-camrecorder"></i>
                                        </a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="si si-options-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><i class="fa fa-user-circle"></i> View profile</li>
                                            <li><i class="fa fa-users"></i>Add friends</li>
                                            <li><i class="fa fa-plus"></i> Add to group</li>
                                            <li><i class="fa fa-ban"></i> Block</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href=""  class="" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"><i class="si si-close text-white"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- action-header end -->

                            <!-- msg_card_body -->
                            <div class="card-body msg_card_body">
                                <div class="chat-box-single-line">
                                    <abbr class="timestamp">February 1st, 2019</abbr>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div class="img_cont_msg">
                                        <img src="{{Auth::user()->profile}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Hi, how are you Jenna Side?
                                        <span class="msg_time">8:40 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end ">
                                    <div class="msg_cotainer_send">
                                        Hi Connor Paige i am good tnx how about you?
                                        <span class="msg_time_send">8:55 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="{{URL::asset('assets/img/faces/9.jpg')}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start ">
                                    <div class="img_cont_msg">
                                        <img src="{{Auth::user()->profile}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        I am good too, thank you for your chat template
                                        <span class="msg_time">9:00 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end ">
                                    <div class="msg_cotainer_send">
                                        You welcome Connor Paige
                                        <span class="msg_time_send">9:05 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="{{URL::asset('assets/img/faces/9.jpg')}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start ">
                                    <div class="img_cont_msg">
                                        <img src="{{Auth::user()->profile}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Yo, Can you update Views?
                                        <span class="msg_time">9:07 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="msg_cotainer_send">
                                        But I must explain to you how all this mistaken  born and I will give
                                        <span class="msg_time_send">9:10 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="{{URL::asset('assets/img/faces/9.jpg')}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start ">
                                    <div class="img_cont_msg">
                                        <img src="{{Auth::user()->profile}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Yo, Can you update Views?
                                        <span class="msg_time">9:07 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="msg_cotainer_send">
                                        But I must explain to you how all this mistaken  born and I will give
                                        <span class="msg_time_send">9:10 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="{{URL::asset('assets/img/faces/9.jpg')}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start ">
                                    <div class="img_cont_msg">
                                        <img src="{{Auth::user()->profile}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Yo, Can you update Views?
                                        <span class="msg_time">9:07 AM, Today</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mb-4">
                                    <div class="msg_cotainer_send">
                                        But I must explain to you how all this mistaken  born and I will give
                                        <span class="msg_time_send">9:10 AM, Today</span>
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="{{URL::asset('assets/img/faces/9.jpg')}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-start">
                                    <div class="img_cont_msg">
                                        <img src="{{Auth::user()->profile}}" class="rounded-circle user_img_msg" alt="img">
                                    </div>
                                    <div class="msg_cotainer">
                                        Okay Bye, text you later..
                                        <span class="msg_time">9:12 AM, Today</span>
                                    </div>
                                </div>
                            </div>
                            <!-- msg_card_body end -->
                            <!-- card-footer -->
                            <div class="card-footer">
                                <div class="msb-reply d-flex">
                                    <div class="input-group">
                                        <input type="text" class="form-control " placeholder="Typing....">
                                        <div class="input-group-text ">
                                            <button type="button" class="btn btn-primary ">
                                                <i class="far fa-paper-plane" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- card-footer end -->
                        </div>
                    </div>
                </div>
            </div>

            <!--Video Modal -->
            <div id="videomodal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark border-0 text-white">
                        <div class="modal-body mx-auto text-center p-7">
                            <h5>Valex Video call</h5>
                            <img src="{{Auth::user()->profile}}" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
                            <h4 class="mb-1 fw-semibold">Daneil Scott</h4>
                            <h6>Calling...</h6>
                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle mb-0 me-3" href="#">
                                            <i class="fas fa-video-slash"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle text-white mb-0 me-3" href="#" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-phone bg-danger text-white"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle mb-0 me-3" href="#">
                                            <i class="fas fa-microphone-slash"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- modal-body -->
                    </div>
                </div><!-- modal-dialog -->
            </div><!-- modal -->

            <!-- Audio Modal -->
            <div id="audiomodal" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0">
                        <div class="modal-body mx-auto text-center p-7">
                            <h5>Valex Voice call</h5>
                            @if(!empty(Auth::user()->profile))
                            <img src="{{Auth::user()->profile}}" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
                            @else
                            <img src="../../assets/img/faces/6.jpg" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
                            @endif
                            <h4 class="mb-1  fw-semibold">Daneil Scott</h4>
                            <h6>Calling...</h6>
                            <div class="mt-5">
                                <div class="row">
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle mb-0 me-3" href="#">
                                            <i class="fas fa-volume-up bg-light text-dark"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="icon icon-shape rounded-circle text-white mb-0 me-3" href="#" data-bs-dismiss="modal" aria-label="Close">
                                            <i class="fas fa-phone text-white bg-success"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <a class="icon icon-shape  rounded-circle mb-0 me-3" href="#">
                                            <i class="fas fa-microphone-slash bg-light text-dark"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- modal-body -->
                    </div>
                </div><!-- modal-dialog -->
            </div><!-- modal -->

            <!-- Footer opened -->
            <!-- <div class="main-footer ht-40">
                <div class="container-fluid pd-t-0-f ht-100p">
                    <span>Copyright © 2021 <a href="#">Valex</a>. Designed by <a href="https://www.spruko.com/">Spruko</a> All rights reserved.</span>
                </div>
            </div> -->
            <!-- Footer closed -->

        </div>
        <!-- End Page -->

        <!-- Back-to-top -->
        <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>

        <!-- JQuery min js -->
        <script src="{{URL::asset('assets/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap Bundle js -->
        <script src="{{URL::asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!--Internal  Chart.bundle js -->
        <script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

        <!-- Ionicons js -->
        <script src="{{URL::asset('assets/plugins/ionicons/ionicons.js')}}"></script>
        <!-- Internal Select2.min js -->
        <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
        <!-- Moment js -->
        <script src="{{URL::asset('assets/plugins/moment/moment.js')}}"></script>

        <!--Internal Sparkline js -->
        <script src="{{URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        <!-- Moment js -->
        <script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>

        <!--Internal Apexchart js-->
        <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>

        <!-- Rating js-->
        <script src="{{URL::asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

        <!--Internal  Perfect-scrollbar js -->
        <script src="{{URL::asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>

        <!-- Eva-icons js -->
        <script src="{{URL::asset('assets/js/eva-icons.min.js')}}"></script>

        <!-- right-sidebar js -->
        <script src="{{URL::asset('assets/plugins/sidebar/sidebar.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>

        <!-- Sticky js -->
        <script src="{{URL::asset('assets/js/sticky.js')}}"></script>
        <script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
        <script src="{{URL::asset('assets/js/daterange.js')}}"></script>


        <!-- Left-menu js-->
        <script src="{{URL::asset('assets/plugins/side-menu/sidemenu.js')}}"></script>

        <!-- Internal Map -->
        <script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
        <!-- Internal Form-editor js -->
        <!-- <script src="{{URL::asset('assets/js/form-editor.js')}}"></script> -->
        	<!--Internal quill js -->
		<!-- <script src="{{URL::asset('assets/plugins/quill/quill.min.js')}}"></script> -->
        <!-- sweetalert2 js-->
        <script src="{{URL::asset('assets/plugins/sweet-alert/sweetalert2.min.js')}}"></script>

        <!--Internal  index js -->
        <script src="{{URL::asset('assets/js/index.js')}}"></script>

        <!-- Apexchart js-->
        <script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
        <script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>
	<!--Internal Fileuploads js-->
    <script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>

		<!--Internal Fancy uploader js-->
		<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
	<!--- Internal Darggable js-->
    <script src="{{URL::asset('assets/plugins/darggable/jquery-ui-darggable.min.js')}}"></script>
		<script src="{{URL::asset('assets/plugins/darggable/darggable.js')}}"></script>
        <!-- Laravel Javascript Validation -->
        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        <script type="text/javascript" src="{{ asset('vendor/DataTables/datatables.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('vendor/DataTables/DataTables-1.11.3/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- custom js -->
        <script src="{{URL::asset('assets/js/custom.js')}}"></script>
        <script src="{{ mix('js/admin.js') }}"></script>
        <script src="{{ URL::asset('js/admin.js') }}"></script>
        @yield('scripts')
        @stack('custom-scripts')
    </body>
</html>
