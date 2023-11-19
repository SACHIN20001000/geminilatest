@extends('admin.layouts.guest')

@section('content')
<div class="container-fluid">
				<div class="row no-gutter">
					<!-- The image half -->
					<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
						<div class="row wd-100p mx-auto text-center">
							<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
								<img src="../../assets/img/media/login.png" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
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
												<a href="index.html"><img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="sign-favicon-a ht-40" alt="logo">
												<img src="{{ !empty(globalSetting()['logo']) ? asset('setting/' . globalSetting()['logo']) : asset('assets/img/brand/logo.png') }}" class="sign-favicon-b ht-40" alt="logo">
												</a>
											</div>
											<div class="main-signup-header">
												<h2 class="text-primary">Get Started</h2>
												<h5 class="fw-normal mb-4">It's free to signup and only takes a minute.</h5>
												<form method="POST" action="{{ route('register') }}">
												@csrf
													<div class="form-group">
														<label>Firstname &amp; Lastname</label>
														<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your firstname and lastname" name="name" required autocomplete="name" autofocus>
															@error('name')
															<span class="invalid-feedback" role="alert">
																<strong>{{ $message }}</strong>
															</span>
															@enderror
													</div>
													<div class="form-group">
														<label>Email</label>
														<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

															@error('email')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
													</div>
													<div class="form-group">
														<label>Password</label>
														<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

															@error('password')
																<span class="invalid-feedback" role="alert">
																	<strong>{{ $message }}</strong>
																</span>
															@enderror
													</div>
													<div class=form-group >
													<label>Confirm Password</label>
													<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
												</div>
													<button class="btn btn-main-primary btn-block">Create Account</button>
													
												</form>
												<div class="main-signup-footer mt-5">
													<p>Already have an account? <a href="{{ url('admin/') }}">Sign In</a></p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- End -->
						</div>
					</div><!-- End -->
				</div>
			</div>


@endsection