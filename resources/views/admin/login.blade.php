@extends('admin.layouts.guest')

@section('content')

<div class="container-fluid">
	<div class="row no-gutter">
		<!-- The image half -->
		<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
			<div class="row wd-100p mx-auto text-center">
				<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
					<img src="{{ !empty(globalSetting()['main_img']) ? asset('setting/' . globalSetting()['main_img']) : asset('assets/img/media/login.png') }}" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
				</div>
			</div>
		</div>
		<!-- The content half -->
		<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
			<div class="login d-flex align-items-center py-2">
				<!-- Demo content-->
				<div class="container p-0">
					<div class="row">
						<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
							<div class="card-sigin">
								<div class="mb-5 d-flex">
									<a href="{{ URL::to('/') }}">
										<img width="300px" src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="main-logo" alt="logo"></a>
								</div>
								<div class="card-sigin">
									<div class="main-signup-header">
										<h2>Welcome back!</h2>
										<h5 class="fw-semibold mb-4">Please sign in to continue.</h5>
										@if(Session::has('message'))
										<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
										@endif
										@if ($errors->any())
										@foreach ($errors->all() as $error)
										<div class="container">
											<div class="alert alert-solid-danger mg-b-0" role="alert">
												<button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
													<span aria-hidden="true">&times;</span>
												</button>
												<strong>Oh snap!</strong> {{ $error }}
											</div>
										</div>

										@endforeach
										@endif
										<form method="POST" action="{{ route('login') }}">
											@csrf
											<div class="form-group">
												<label>Email</label> <input class="form-control" placeholder="Enter your email" type="text" name='email' id='email' required="required" autocomplete='email' autofocus='autofocus'>
											</div>
											<div class="form-group">
												<label>Password</label> <input class="form-control" placeholder="Enter your password" type="password" name="password" id='password' autocomplete="current-password">
											</div><button class="btn btn-main-primary btn-block">Sign In</button>
											<!-- <div class="row row-xs">
															<div class="col-sm-6">
																<button class="btn btn-block"><i class="fab fa-facebook-f"></i> Signup with Facebook</button>
															</div>
															<div class="col-sm-6 mg-t-10 mg-sm-t-0">
																<button class="btn btn-info btn-block btn-b"><i class="fab fa-twitter"></i> Signup with Twitter</button>
															</div>
														</div> -->
										</form>
										<div class="main-signin-footer mt-5">
											<div class="row">
												<div class="col-lg-6">
													<p><a class="btn btn-info btn-block btn-b" href="{{ url('admin/register') }}">Register?</a></p>
												</div>
												<div class="col-lg-6">
													<p><a class="btn btn-danger btn-block" href="{{ url('admin/forgotPassword') }}">Forgot password?</a></p>
												</div>
											</div>


										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- End -->
			</div>
		</div><!-- End -->
	</div>
	@endsection