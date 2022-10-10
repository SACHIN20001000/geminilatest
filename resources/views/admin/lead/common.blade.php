<div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a href="{{ route('leads.index',['id'=> 1]) }}" class="@if(isset($_GET['id']) && $_GET['id'] == 1) btn btn-warning @else btn btn-info @endif ml_auto" 
											>New Leads</a>
							</div>
						</div>
                        <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a  href="{{ route('leads.index',['id'=> 2]) }}" class="@if(isset($_GET['id']) && $_GET['id'] == 2) btn btn-warning @else btn btn-info @endif ml_auto" 
											>Quote Lead</a>
							</div>
						</div>
                        <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown">
                            <a  href="{{ route('leads.index',['id'=> 3]) }}" class="@if(isset($_GET['id']) && $_GET['id'] == 3) btn btn-warning @else btn btn-info @endif ml_auto">Policy Issued</a>
							</div>
						</div>
                        <div class="pe-4 mb-xl-0">
							<div class="btn-group dropdown ">
                            <a  href="{{ route('leads.index',['id'=> 4]) }}" class="@if(isset($_GET['id']) && $_GET['id'] == 4) btn btn-warning @else btn btn-info @endif ml_auto">Opportunities</a>
							</div>
						</div>
          