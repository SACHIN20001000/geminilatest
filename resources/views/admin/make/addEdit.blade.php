@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Model</h4><span class="text-muted mt-1 tx-13 ms-2 mb-0">/ {{isset($make) ? $make->name : 'Add New' }}</span>
            </div>
        </div>
        <a class="btn btn-main-primary ml_auto" style="margin-left: 740px;" href="{{ route('model.index') }}">View Model</a>


    </div>
    <!-- breadcrumb -->
    <!--Row-->
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        {{isset($make) ? 'Update # '.$make->id : 'Add New' }}
                    </div>


                    <!--  start  -->
                    <form  id="user-add-edit" action="{{isset($make) ? route('model.update',$make->id) : route('model.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{ isset($make) ? method_field('PUT'):'' }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            
                         
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Details</h4>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">Make</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <select name="make_id" id="make_id"class="form-control">
                                                <option value="">Select Below</option>
                                                @if($makes->count())
                                                @foreach($makes as $makies)
                                                <option value="{{$makies->id}}" {{isset($make) && $make->make_id == $makies->id ? 'selected':'' }}>{{$makies->name}}</option>

                                                @endforeach
                                                @endif
                                            </select>   
                                            
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">Name</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="name"  placeholder="Enter your name" type="text" value="{{isset($make) ? $make->name : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                    
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Variant</h4>
                                        <div class="btn btn-primary" id="add-variant"> Add Variant</div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <!-- <label class="form-label mg-b-0"> Variant</label> -->
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 vairants">
                                                @if(!empty($make->makeModels))
                                                    @foreach($make->makeModels as $varient)
                                                    @if($varient->type == 'varriant')
                                                    <div>                                            
                                                        <input class="form-control mb-2" name="varriant_id[]"  placeholder="Enter your Variants name" type="text" value="{{$varient->name}}" >
                                                    <span class="btn btn-danger mb-2 deletVarient"> <i class="las la-trash" ></i></span> 
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                           
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Fuel</h4>
                                        <div class="btn btn-primary" id="add-fuel"> Add Fuel</div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <!-- <label class="form-label mg-b-0"> Variant</label> -->
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 fuel">
                                                @if(!empty($make->makeModels))
                                                    @foreach($make->makeModels as $varient)
                                                    @if($varient->type == 'fuel')
                                                    <div>                                            
                                                        <input class="form-control mb-2" name="fuel_id[]"  placeholder="Enter your Fule" type="text" value="{{$varient->name}}" >
                                                    <span class="btn btn-danger mb-2 deletFuel"> <i class="las la-trash" ></i></span> 
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>CC/KW</h4>
                                        <div class="btn btn-primary" id="add-cc"> Add CC/KW</div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <!-- <label class="form-label mg-b-0"> Variant</label> -->
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 cc">
                                                @if(!empty($make->makeModels))
                                                    @foreach($make->makeModels as $varient)
                                                    @if($varient->type == 'cc')
                                                    <div>                                            
                                                        <input class="form-control mb-2" name="cc_id[]"  placeholder="Enter your CC/KW " type="text" value="{{$varient->name}}" >
                                                    <span class="btn btn-danger mb-2 deletCC"> <i class="las la-trash" ></i></span> 
                                                    </div>
                                                    @endif

                                                    @endforeach
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Seating Capacity</h4>
                                        <div class="btn btn-primary" id="add-seating"> Add Seating Capacity</div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <!-- <label class="form-label mg-b-0"> Variant</label> -->
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 seating">
                                                @if(!empty($make->makeModels))
                                                    @foreach($make->makeModels as $varient)
                                                    @if($varient->type == 'seating')
                                                    <div>                                            
                                                        <input class="form-control mb-2" name="seating_id[]"  placeholder="Enter your Seating Capacity" type="text" value="{{$varient->name}}" >
                                                    <span class="btn btn-danger mb-2 deleteSeating"> <i class="las la-trash" ></i></span> 
                                                    </div>
                                                    @endif

                                                    @endforeach
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Ex Show Room Price</h4>
                                        <div class="btn btn-primary" id="add-ex-showroom"> Add Ex Show Room Price</div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <!-- <label class="form-label mg-b-0"> Variant</label> -->
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 showroom">
                                                @if(!empty($make->makeModels))
                                                    @foreach($make->makeModels as $varient)
                                                    @if($varient->type == 'showroom')
                                                    <div>                                            
                                                        <input class="form-control mb-2" name="showroom_id[]"  placeholder="Enter your Showrrom Price" type="text" value="{{$varient->name}}" >
                                                    <span class="btn btn-danger mb-2 deleteShowroom"> <i class="las la-trash" ></i></span> 
                                                    </div>
                                                    @endif

                                                    @endforeach
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>OD Factor</h4>
                                        <div class="btn btn-primary" id="add-od"> Add OD Factor</div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <!-- <label class="form-label mg-b-0"> Variant</label> -->
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 od">
                                                @if(!empty($make->makeModels))
                                                    @foreach($make->makeModels as $varient)
                                                    @if($varient->type == 'od')
                                                    <div>                                            
                                                        <input class="form-control mb-2" name="od_id[]"  placeholder="Enter your OD factor" type="text" value="{{$varient->name}}" >
                                                    <span class="btn btn-danger mb-2 deletOd"> <i class="las la-trash" ></i></span> 
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>TP Premium</h4>
                                        <div class="btn btn-primary" id="add-tp"> Add TP Premium</div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <!-- <label class="form-label mg-b-0"> Variant</label> -->
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 tp">
                                                @if(!empty($make->makeModels))
                                                    @foreach($make->makeModels as $varient)
                                                    @if($varient->type == 'tp')
                                                    <div>                                            
                                                        <input class="form-control mb-2" name="tp_id[]"  placeholder="Enter your TP Premium" type="text" value="{{$varient->name}}" >
                                                    <span class="btn btn-danger mb-2 delettp"> <i class="las la-trash" ></i></span> 
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                @endif
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </div>
                            <button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5" type="submit">{{isset($make) ? 'Update' : 'Save' }}</button>
                        </div>
                </div>
                </form>
                <!-- form end  -->
            </div>
        </div>
    </div>
    <!-- /row -->
</div>


@endsection


@section('scripts')

{!! JsValidator::formRequest('App\Http\Requests\Admin\Make\StoreMakeRequest','#user-add-edit') !!}

<script type="text/javascript">
      $(document).ready(function() {
        $('#add-variant').click(function(){
            
            $('.vairants').append('<input class="form-control mb-2" name="varriant_id[]"  placeholder="Enter your Variants name" type="text">')
        })
        $('#add-model').click(function(){
            
            $('.models').append('<input class="form-control mb-2" name="model_id[]"  placeholder="Enter your Model name" type="text">')
        })
        $('#add-tp').click(function(){
            
            $('.tp').append('<input class="form-control mb-2" name="tp_id[]"  placeholder="Enter" type="text">')
        })
        $('#add-od').click(function(){
            
            $('.od').append('<input class="form-control mb-2" name="od_id[]"  placeholder="Enter" type="text">')
        })
        $('#add-ex-showroom').click(function(){
            
            $('.showroom').append('<input class="form-control mb-2" name="showroom_id[]"  placeholder="Enter" type="text">')
        })
        $('#add-seating').click(function(){
            
            $('.seating').append('<input class="form-control mb-2" name="seating_id[]"  placeholder="Enter" type="text">')
        })
        $('#add-cc').click(function(){
            
            $('.cc').append('<input class="form-control mb-2" name="cc_id[]"  placeholder="Enter" type="text">')
        })
        $('#add-fuel').click(function(){
            
            $('.fuel').append('<input class="form-control mb-2" name="fuel_id[]"  placeholder="Enter" type="text">')
        })
  
                                         
        $('.deletVarient').click(function(){
            
            $(this).parent('div').remove();
        })
        $('.delettp').click(function(){
            
            $(this).parent('div').remove();
        })
        $('.deletOd').click(function(){
            
            $(this).parent('div').remove();
        })
        $('.deleteShowroom').click(function(){
            
            $(this).parent('div').remove();
        })
        $('.deleteSeating').click(function(){
            
            $(this).parent('div').remove();
        })
        $('.deletCC').click(function(){
            
            $(this).parent('div').remove();
        })
        $('.deletModel').click(function(){
            
            $(this).parent('div').remove();
        })
       
      });
      
</script>
@endsection


