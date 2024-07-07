<style>
    span.side-menu__label {
        margin-left: 12px;
    }
</style>
<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ route('dashboard') }}"><img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    @if(!empty(Auth::user()->profile))
                    <img class="avatar avatar-xl brround" src="{{URL::asset('profile')}}/{{Auth::user()->profile}}"><span class="avatar-status profile-status bg-green"></span>
                    @else
                    <img src="{{URL::asset('assets/img/faces/6.jpg')}}" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
                    @endif

                </div>
                <div class="user-info">
                    <h4 class="fw-semibold mt-3 mb-0">{{ auth()->user()->name ?? 'Petey Cruiser' }}</h4>
                    <span class="mb-0 text-muted">{{ auth()->user()->email??'' }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="side-item side-item-category">Main</li>
            <li class="slide">
                <a class="side-menu__item" href="{{ route('dashboard') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                        <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                    </svg><span class="side-menu__label">Dashboard</span><span class="badge bg-success text-light" id="bg-side-text"></span></a>
            </li>
           
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="#" >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/></svg>  
                <span class="side-menu__label">Users </span><i class="angle fe fe-chevron-down"></i></a>

                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{route('users.index')}}">Users</a></li>
                    <li><a class="slide-item" href="{{ route('insurance.index') }}">Insurance</a></li>
                    <li><a class="slide-item" href="{{ route('product.index') }}">Product</a></li>
                    <li><a class="slide-item" href="{{ route('subproduct.index') }}">SubProduct</a></li>
                    <li><a class="slide-item" href="{{ route('make.index') }}">Make</a></li>
                    <li><a class="slide-item" href="{{ route('channel.index') }}">Channel</a></li>

                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" />
                    </svg><span class="side-menu__label">Features </span><i class="angle fe fe-chevron-down"></i></a>

                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('company.index') }}">Company</a></li>
                    <li><a class="slide-item" href="{{ route('insurance.index') }}">Insurance</a></li>
                    <li><a class="slide-item" href="{{ route('product.index') }}">Product</a></li>
                    <li><a class="slide-item" href="{{ route('subproduct.index') }}">SubProduct</a></li>
                    <li><a class="slide-item" href="{{ route('make.index') }}">Make</a></li>
                    <li><a class="slide-item" href="{{ route('channel.index') }}">Channel</a></li>

                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{route('leads.index')}}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1H14a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0V8h-5v.5a.5.5 0 0 1-1 0v-1A.5.5 0 0 1 2 7h5.5V6A1.5 1.5 0 0 1 6 4.5v-1zM8.5 5a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1zM0 11.5A1.5 1.5 0 0 1 1.5 10h1A1.5 1.5 0 0 1 4 11.5v1A1.5 1.5 0 0 1 2.5 14h-1A1.5 1.5 0 0 1 0 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5A1.5 1.5 0 0 1 7.5 10h1a1.5 1.5 0 0 1 1.5 1.5v1A1.5 1.5 0 0 1 8.5 14h-1A1.5 1.5 0 0 1 6 12.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zm4.5.5a1.5 1.5 0 0 1 1.5-1.5h1a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1zm1.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z" />
                    </svg><span class="side-menu__label">Lead </span></a>
            </li>



        </ul>
        </li>
        </ul>
    </div>
</aside>
<div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">
    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ route('dashboard') }}"><img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
    </div>
    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    @if(!empty(Auth::user()->profile))
                    <img class="avatar avatar-xl brround" src="{{URL::asset('profile')}}/{{Auth::user()->profile}}"><span class="avatar-status profile-status bg-green"></span>
                    @else
                    <img src="{{URL::asset('assets/img/faces/6.jpg')}}" class="rounded-circle user-img-circle h-8 w-8 mt-4 mb-3" alt="img">
                    @endif

                </div>
                <div class="user-info">
                    <h4 class="fw-semibold mt-3 mb-0">{{ auth()->user()->name ?? 'Petey Cruiser' }}</h4>
                    <span class="mb-0 text-muted">{{ auth()->user()->email??'' }}</span>
                </div>
            </div>
        </div>
        <ul class="side-menu">
            <li class="slide">
                <a class="side-menu__item" href="{{ route('dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="#0162e8" d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Dashboard</span><span class="badge bg-success text-light" id="bg-side-text"></span></a>
            </li>
            @if( Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Staff'))
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="20" height="20" fill="#0162e8"><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>    
                <span class="side-menu__label">Users </span><i class="angle fe fe-chevron-down"></i></a>

                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{route('users.index')}}">Users</a></li>
                    <li><a class="slide-item" href="{{route('importUserView')}}">Import</a></li>


                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
                        <g transform="translate(256 0) scale(-1 1)">
                            <g id="galaSettings0" fill="none" stroke="#0162e8" stroke-dasharray="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="4" stroke-opacity="1" stroke-width="16">
                                <path id="galaSettings1" d="M 48.000002,16 H 208 c 17.728,0 32,14.272 32,32 v 160 c 0,17.728 -14.272,32 -32,32 H 48.000002 c -17.728,0 -32,-14.272 -32,-32 V 48 c 0,-17.728 14.272,-32 32,-32 z" />
                                <path id="galaSettings2" d="M 64.000006,64.000001 H 79.999993" />
                                <path id="galaSettings3" d="m 79.999996,-96.000015 a 16,16 0 0 1 -16,16 16,16 0 0 1 -16,-16 16,16 0 0 1 16,-16.000005 16,16 0 0 1 16,16.000005 z" transform="rotate(90)" />
                                <path id="galaSettings4" d="m 112.00001,64.000353 79.99997,-3.52e-4" />
                                <path id="galaSettings5" d="M 191.99998,128 H 176" />
                                <path id="galaSettings6" d="m 144,159.99997 a 16,16 0 0 1 -16,16 16,16 0 0 1 -16,-16 16,16 0 0 1 16,-16 16,16 0 0 1 16,16 z" transform="matrix(0 1 1 0 0 0)" />
                                <path id="galaSettings7" d="M 143.99998,128.00035 64.000006,128" />
                                <path id="galaSettings8" d="M 64.000006,192.00001 H 79.999993" />
                                <path id="galaSettings9" d="m 208,-96.000015 a 16,16 0 0 1 -16,16 16,16 0 0 1 -16,-16 16,16 0 0 1 16,-16.000005 16,16 0 0 1 16,16.000005 z" transform="rotate(90)" />
                                <path id="galaSettingsa" d="m 112.00001,192.00036 79.99997,-3.5e-4" />
                            </g>
                        </g>
                    </svg>
                    <span class="side-menu__label">Features </span><i class="angle fe fe-chevron-down"></i></a>

                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('company.index') }}">Company</a></li>
                    <li><a class="slide-item" href="{{ route('insurance.index') }}">Insurance</a></li>
                    <li><a class="slide-item" href="{{ route('product.index') }}">Product</a></li>
                    <li><a class="slide-item" href="{{ route('subproduct.index') }}">SubProduct</a></li>
                    <li><a class="slide-item" href="{{ route('channel.index') }}">Channel</a></li>
                    <li><a class="slide-item" href="{{ route('make.index') }}">Make</a></li>
                    <li><a class="slide-item" href="{{ route('model.index') }}">Varriant</a></li>
                    <li><a class="slide-item" href="{{ route('vecialView') }}">Vehicle Import</a></li>


                </ul>
            </li>

            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('leads.index',['id'=> 1]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="#0162e8" d="M10 4c2.2 0 4 1.8 4 4s-1.8 4-4 4s-4-1.8-4-4s1.8-4 4-4m7 17l1.8 1.77c.5.5 1.2.1 1.2-.49V18l2.8-3.4A1 1 0 0 0 22 13h-7c-.8 0-1.3 1-.8 1.6L17 18v3m-2-2.3l-2.3-2.8c-.4-.5-.6-1.1-.6-1.7c-.7-.2-1.4-.2-2.1-.2c-4.4 0-8 1.8-8 4v2h13v-1.3Z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Lead (<?php echo count_lead() ?>) </span></a>


            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="#0162e8" d="M12 21.9q-.175 0-.325-.025t-.3-.075Q8 20.675 6 17.638T4 11.1V6.375q0-.625.363-1.125t.937-.725l6-2.25q.35-.125.7-.125t.7.125l6 2.25q.575.225.938.725T20 6.375V11.1q0 1.575-.413 3.063T18.4 17l-2.95-2.95q.275-.475.413-.988T16 12q0-1.65-1.175-2.825T12 8q-1.65 0-2.825 1.175T8 12q0 1.65 1.175 2.825T12 16q.525 0 1.038-.138T14 15.45l3.225 3.2q-.95 1.125-2.087 1.913T12.625 21.8q-.15.05-.3.075T12 21.9Zm0-7.9q-.825 0-1.413-.587T10 12q0-.825.588-1.413T12 10q.825 0 1.413.588T14 12q0 .825-.588 1.413T12 14Z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Policy (<?php echo new_policy() ?>)</span> <i class="angle fe fe-chevron-down"></i></a>

                <ul class="slide-menu">
                    <!-- <li><a class="slide-item" href="{{ route('policy.index',['id'=> 1]) }}">Policy</a></li> -->
                    <li><a class="slide-item" href="{{ route('new-policy.index',['id'=> 1]) }}">Policy</a></li>
                    

                    <li><a class="slide-item" href="{{ route('policyView') }}">Import</a></li>
                </ul>

            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('new-policy.index',['id'=> 2]) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="#0162e8" d="M12 21.9q-.175 0-.325-.025t-.3-.075Q8 20.675 6 17.638T4 11.1V6.375q0-.625.363-1.125t.937-.725l6-2.25q.35-.125.7-.125t.7.125l6 2.25q.575.225.938.725T20 6.375V11.1q0 1.575-.413 3.063T18.4 17l-2.95-2.95q.275-.475.413-.988T16 12q0-1.65-1.175-2.825T12 8q-1.65 0-2.825 1.175T8 12q0 1.65 1.175 2.825T12 16q.525 0 1.038-.138T14 15.45l3.225 3.2q-.95 1.125-2.087 1.913T12.625 21.8q-.15.05-.3.075T12 21.9Zm0-7.9q-.825 0-1.413-.587T10 12q0-.825.588-1.413T12 10q.825 0 1.413.588T14 12q0 .825-.588 1.413T12 14Z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Renewals</span></a>


            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('ticket.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <g transform="translate(48 0) scale(-1 1)">
                            <g fill="none" stroke="#0162e8" stroke-linecap="round" stroke-width="4">
                                <path stroke-linejoin="round" d="M9 16L34 6l4 10M4 16h40v6c-3 0-6 2-6 5.5s3 6.5 6 6.5v6H4v-6c3 0 6-2 6-6s-3-6-6-6v-6Z" />
                                <path d="M17 25.385h6m-6 6h14" />
                            </g>
                        </g>
                    </svg>
                    <span class="side-menu__label">Endorsement</span></a>


            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="#0162e8" d="m10.2 13.2l-1.05-1.05q.2-.275.275-.563T9.5 11q0-.3-.075-.588t-.275-.537L10.2 8.8q.4.475.6 1.05T11 11q0 .575-.2 1.138t-.6 1.062Zm2.125 2.15l-1.075-1.075q.625-.7.938-1.55T12.5 11q0-.875-.312-1.712T11.25 7.75l1.075-1.075q.85.925 1.263 2.038T14 11q0 1.175-.413 2.3t-1.262 2.05ZM5 12q-.825 0-1.413-.588T3 10q0-.825.588-1.413T5 8q.825 0 1.413.588T7 10q0 .825-.588 1.413T5 12Zm-4 4v-.575q0-.6.325-1.1t.9-.75q.65-.275 1.338-.425T5 13q.75 0 1.438.15t1.337.425q.575.25.9.75t.325 1.1V16H1Zm18-4q-.825 0-1.413-.588T17 10q0-.825.588-1.413T19 8q.825 0 1.413.588T21 10q0 .825-.588 1.413T19 12Zm-4 4v-.575q0-.6.325-1.1t.9-.75q.65-.275 1.337-.425T19 13q.75 0 1.437.15t1.338.425q.575.25.9.75t.325 1.1V16h-8Z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Communication</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('chat') }}">Chat</a></li>
                    <li><a class="slide-item" href="{{ route('whatsapp') }}">Whatsapp</a></li>
                    <li><a class="slide-item" href="{{ route('group.index') }}">Group</a></li>
                    <li><a class="slide-item" href="{{ route('communications.index') }}">Communication</a></li>
                </ul>

            </li>


            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('report.index') }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="none" stroke="#0162e8" stroke-width="1.5" d="M9 21h6m-6 0v-5m0 5H3.6a.6.6 0 0 1-.6-.6v-3.8a.6.6 0 0 1 .6-.6H9m6 5V9m0 12h5.4a.6.6 0 0 0 .6-.6V3.6a.6.6 0 0 0-.6-.6h-4.8a.6.6 0 0 0-.6.6V9m0 0H9.6a.6.6 0 0 0-.6.6V16" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Report </span></a>


            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 384 512">
                        <g transform="translate(384 0) scale(-1 1)">
                            <path fill="#0162e8" d="M64 0C28.7 0 0 28.7 0 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zm192 0v128h128L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5.1c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16v-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5.8 4.8 1.6 7.1 2.4c13.6 4.6 24.6 8.4 36.3 8.7c9.1.3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Payouts</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('new-payout.index') }}">Payout</a></li>
                    <li><a class="slide-item" href="{{ route('invoice') }}">Pending Invoice</a></li>
                    <li><a class="slide-item" href="{{ route('invoice.verified',['id'=> 1])  }}">Verified Invoice</a></li>
                    <li><a class="slide-item" href="{{ route('users.index',['id'=> 2,'advance'=>1]) }}">Advance Payment</a></li>
                </ul>

            </li>


            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('notepad.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <g transform="translate(48 0) scale(-1 1)">
                            <g fill="none" stroke="#0162e8" stroke-width="4">
                                <path d="M18 8H11C10.4477 8 10 8.44772 10 9V43C10 43.5523 10.4477 44 11 44H39C39.5523 44 40 43.5523 40 43V9C40 8.44772 39.5523 8 39 8H32" />
                                <path fill="#2F88FF" d="M18 13V8H21.9505C21.9778 8 22 7.97784 22 7.9505V6C22 4.34315 23.3431 3 25 3C26.6569 3 28 4.34315 28 6V7.9505C28 7.97784 28.0222 8 28.0495 8H32V13C32 13.5523 31.5523 14 31 14H19C18.4477 14 18 13.5523 18 13Z" />
                            </g>
                        </g>
                    </svg>
                    <span class="side-menu__label">Notepad</span></a>


            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('expences.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <g transform="translate(48 0) scale(-1 1)">
                            <g fill="none" stroke="#0162e8" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                                <path d="M31 34h12m-5 5l5-5l-5-5" />
                                <path d="M43 26V10a3 3 0 0 0-3-3H8a3 3 0 0 0-3 3v28a3 3 0 0 0 3 3h20.47" />
                                <path d="m15 15l5 6l5-6M14 27h12m-12-6h12m-6 0v12" />
                            </g>
                        </g>
                    </svg>
                    <span class="side-menu__label">Expenses</span></a>


            </li>
<!-- 
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('income.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <g transform="translate(48 0) scale(-1 1)">
                            <g fill="none" stroke="#0162e8" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                                <path d="m35 38l-5-5l5-5m8 10l-5-5l5-5" />
                                <path d="M43 22V9a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v30a2 2 0 0 0 2 2h21.47" />
                                <path d="m13 15l5 6l5-6M12 27h12m-12-6h12m-6 0v12" />
                            </g>
                        </g>
                    </svg>
                    <span class="side-menu__label">Reconciliation</span></a>


            </li> -->
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('reconciliation.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <g transform="translate(48 0) scale(-1 1)">
                            <g fill="none" stroke="#0162e8" stroke-linecap="round" stroke-linejoin="round" stroke-width="4">
                                <path d="m35 38l-5-5l5-5m8 10l-5-5l5-5" />
                                <path d="M43 22V9a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v30a2 2 0 0 0 2 2h21.47" />
                                <path d="m13 15l5 6l5-6M12 27h12m-12-6h12m-6 0v12" />
                            </g>
                        </g>
                    </svg>
                    <span class="side-menu__label">Reconciliation</span></a>


            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('remainder.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 2048 2048">
                        <g transform="translate(2048 0) scale(-1 1)">
                            <path fill="#0162e8" d="M2048 384v640h-128V648l-896 447l-896-447v888h896v128H0V384h2048zM1024 953l881-441H143l881 441zm576 199q66 0 124 25t101 69t69 102t26 124v192h128v128h-256v64q0 40-15 75t-41 61t-61 41t-75 15q-40 0-75-15t-61-41t-41-61t-15-75v-64h-256v-128h128v-192q0-66 25-124t68-101t102-69t125-26zm64 640h-128v64q0 26 19 45t45 19q26 0 45-19t19-45v-64zm128-128v-192q0-40-15-75t-41-61t-61-41t-75-15q-40 0-75 15t-61 41t-41 61t-15 75v192h384z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Reminder</span></a>


            </li>



            @endif
            @if( Auth::user()->hasRole('Broker') )

          
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('leads.index',['id'=> 1]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="#0162e8" d="M10 4c2.2 0 4 1.8 4 4s-1.8 4-4 4s-4-1.8-4-4s1.8-4 4-4m7 17l1.8 1.77c.5.5 1.2.1 1.2-.49V18l2.8-3.4A1 1 0 0 0 22 13h-7c-.8 0-1.3 1-.8 1.6L17 18v3m-2-2.3l-2.3-2.8c-.4-.5-.6-1.1-.6-1.7c-.7-.2-1.4-.2-2.1-.2c-4.4 0-8 1.8-8 4v2h13v-1.3Z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Lead (<?php echo count_lead() ?>) </span></a>


            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="#0162e8" d="M12 21.9q-.175 0-.325-.025t-.3-.075Q8 20.675 6 17.638T4 11.1V6.375q0-.625.363-1.125t.937-.725l6-2.25q.35-.125.7-.125t.7.125l6 2.25q.575.225.938.725T20 6.375V11.1q0 1.575-.413 3.063T18.4 17l-2.95-2.95q.275-.475.413-.988T16 12q0-1.65-1.175-2.825T12 8q-1.65 0-2.825 1.175T8 12q0 1.65 1.175 2.825T12 16q.525 0 1.038-.138T14 15.45l3.225 3.2q-.95 1.125-2.087 1.913T12.625 21.8q-.15.05-.3.075T12 21.9Zm0-7.9q-.825 0-1.413-.587T10 12q0-.825.588-1.413T12 10q.825 0 1.413.588T14 12q0 .825-.588 1.413T12 14Z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Policy (<?php echo new_policy() ?>)</span> <i class="angle fe fe-chevron-down"></i></a>

                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('new-policy.index',['id'=> 1]) }}">New Policy</a></li>
                </ul>

            </li>

            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 384 512">
                        <g transform="translate(384 0) scale(-1 1)">
                            <path fill="#0162e8" d="M64 0C28.7 0 0 28.7 0 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zm192 0v128h128L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5.1c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16v-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5.8 4.8 1.6 7.1 2.4c13.6 4.6 24.6 8.4 36.3 8.7c9.1.3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Payouts</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('new-payout.index') }}">Payout</a></li>
                    <li><a class="slide-item" href="{{ route('invoice') }}">Pending Invoice</a></li>
                    <li><a class="slide-item" href="{{ route('invoice.verified',['id'=> 1])  }}">Verified Invoice</a></li>
                    <li><a class="slide-item" href="{{ route('users.index',['id'=> 2,'advance'=>1]) }}">Advance Payment</a></li>
                </ul>

            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('ticket.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <g transform="translate(48 0) scale(-1 1)">
                            <g fill="none" stroke="#0162e8" stroke-linecap="round" stroke-width="4">
                                <path stroke-linejoin="round" d="M9 16L34 6l4 10M4 16h40v6c-3 0-6 2-6 5.5s3 6.5 6 6.5v6H4v-6c3 0 6-2 6-6s-3-6-6-6v-6Z" />
                                <path d="M17 25.385h6m-6 6h14" />
                            </g>
                        </g>
                    </svg>
                    <span class="side-menu__label">Endrosment</span></a>


            </li>



            @endif
            @if( Auth::user()->hasRole('Client') )

            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide" href="{{ route('leads.index',['id'=> 1]) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="#0162e8" d="M10 4c2.2 0 4 1.8 4 4s-1.8 4-4 4s-4-1.8-4-4s1.8-4 4-4m7 17l1.8 1.77c.5.5 1.2.1 1.2-.49V18l2.8-3.4A1 1 0 0 0 22 13h-7c-.8 0-1.3 1-.8 1.6L17 18v3m-2-2.3l-2.3-2.8c-.4-.5-.6-1.1-.6-1.7c-.7-.2-1.4-.2-2.1-.2c-4.4 0-8 1.8-8 4v2h13v-1.3Z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Lead (<?php echo count_lead() ?>) </span></a>


            </li>
            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g transform="translate(24 0) scale(-1 1)">
                            <path fill="#0162e8" d="M12 21.9q-.175 0-.325-.025t-.3-.075Q8 20.675 6 17.638T4 11.1V6.375q0-.625.363-1.125t.937-.725l6-2.25q.35-.125.7-.125t.7.125l6 2.25q.575.225.938.725T20 6.375V11.1q0 1.575-.413 3.063T18.4 17l-2.95-2.95q.275-.475.413-.988T16 12q0-1.65-1.175-2.825T12 8q-1.65 0-2.825 1.175T8 12q0 1.65 1.175 2.825T12 16q.525 0 1.038-.138T14 15.45l3.225 3.2q-.95 1.125-2.087 1.913T12.625 21.8q-.15.05-.3.075T12 21.9Zm0-7.9q-.825 0-1.413-.587T10 12q0-.825.588-1.413T12 10q.825 0 1.413.588T14 12q0 .825-.588 1.413T12 14Z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Policy (<?php echo new_policy() ?>)</span> <i class="angle fe fe-chevron-down"></i></a>

                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('new-policy.index',['id'=> 1]) }}">New Policy</a></li>
                </ul>

            </li>

            <li class="slide">
                <a class="side-menu__item" data-bs-toggle="slide">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 384 512">
                        <g transform="translate(384 0) scale(-1 1)">
                            <path fill="#0162e8" d="M64 0C28.7 0 0 28.7 0 64v384c0 35.3 28.7 64 64 64h256c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zm192 0v128h128L256 0zM64 80c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16zm128 72c8.8 0 16 7.2 16 16v17.3c8.5 1.2 16.7 3.1 24.1 5.1c8.5 2.3 13.6 11 11.3 19.6s-11 13.6-19.6 11.3c-11.1-3-22-5.2-32.1-5.3c-8.4-.1-17.4 1.8-23.6 5.5c-5.7 3.4-8.1 7.3-8.1 12.8c0 3.7 1.3 6.5 7.3 10.1c6.9 4.1 16.6 7.1 29.2 10.9l.5.1c11.3 3.4 25.3 7.6 36.3 14.6c12.1 7.6 22.4 19.7 22.7 38.2c.3 19.3-9.6 33.3-22.9 41.6c-7.7 4.8-16.4 7.6-25.1 9.1V440c0 8.8-7.2 16-16 16s-16-7.2-16-16v-17.8c-11.2-2.1-21.7-5.7-30.9-8.9c-2.1-.7-4.2-1.4-6.2-2.1c-8.4-2.8-12.9-11.9-10.1-20.2s11.9-12.9 20.2-10.1c2.5.8 4.8 1.6 7.1 2.4c13.6 4.6 24.6 8.4 36.3 8.7c9.1.3 17.9-1.7 23.7-5.3c5.1-3.2 7.9-7.3 7.8-14c-.1-4.6-1.8-7.8-7.7-11.6c-6.8-4.3-16.5-7.4-29-11.2l-1.6-.5c-11-3.3-24.3-7.3-34.8-13.7c-12-7.2-22.6-18.9-22.7-37.3c-.1-19.4 10.8-32.8 23.8-40.5c7.5-4.4 15.8-7.2 24.1-8.7V232c0-8.8 7.2-16 16-16z" />
                        </g>
                    </svg>
                    <span class="side-menu__label">Payouts</span><i class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('new-payout.index') }}">Payout</a></li>
                    <li><a class="slide-item" href="{{ route('invoice') }}">Pending Invoice</a></li>
                    <li><a class="slide-item" href="{{ route('invoice.verified',['id'=> 1])  }}">Verified Invoice</a></li>
                    <li><a class="slide-item" href="{{ route('users.index',['id'=> 2,'advance'=>1]) }}">Advance Payment</a></li>
                </ul>

            </li>




            @endif



        </ul>
        </li>
        </ul>
    </div>
</aside>