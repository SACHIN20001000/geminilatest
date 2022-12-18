<div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a href="{{ route('policy.index',['id'=> 1]) }}" class=" @if(isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto" 
											>MIS</a>
							</div>
						</div>
                        <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a  href="{{ route('policy.index',['id'=> 2]) }}" class=" @if(isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif  ml_auto" 
											>Renewals</a>
							</div>
						</div>
                 
           