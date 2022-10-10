<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="  content-title mb-0 my-auto pe-4">Leads</h4>
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
            </div>
        </div>
       
        <div class="d-flex my-xl-auto right-content">
						<div class="pe-1 mb-xl-0 filter-btn">
                        
							<button type="button" class="btn btn-info btn-icon me-2 btn-b"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pe-1 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon me-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pe-1 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon me-2"><i class="mdi mdi-refresh"></i></button>
						</div>
                        <div class="pe-1 mb-xl-0">
							<div class="btn-group dropdown assigned-btn">
                            <a  class="modal-effect btn btn-main-primary ml_auto "
											data-bs-effect="effect-super-scaled"  
											>Assign</a>
							</div>
						</div>
						<div class="mb-xl-0">
							<div class="btn-group dropdown">
                            <a class="btn btn-main-primary ml_auto" href="{{ route('leads.create',['id'=> $_GET['id']??'') }}">Add Leads</a>
							</div>
						</div>
					</div>
    </div>
    <!-- breadcrumb -->