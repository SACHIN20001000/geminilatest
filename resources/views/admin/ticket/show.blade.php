@extends('admin.layouts.app')
@section('content')

<div class="container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">View Ticket</h4>
            </div>
        </div>

        <div class="d-flex my-xl-auto right-content">
            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown">
                    <button class="modal-effect btn btn-main-primary ml_auto " data-bs-toggle="modal" href="#attachments" data-bs-effect="effect-super-scaled">Update Details</button>

                </div>
            </div>
            <div class="pe-1 mb-xl-0">
                <div class="btn-group dropdown">
                    <a class="btn btn-main-primary ml_auto" href="{{ route('ticket.index') }}">View ticket</a>

                </div>
            </div>

        </div>

    </div>
    <!-- breadcrumb -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                    <div class="card-body">

                        <div class="row mg-t-20">

                            <div class="col-lg-6">

                                <label class="tx-gray-600">Ticket Information</label>
                                <p class="invoice-info-row"><span>Policy Number</span> <span>{{$ticket->policy->policy_no ?? ''}}</span></p>
                                <p class="invoice-info-row"><span>Reference name</span> <span>{{$ticket->policy->users->name ?? ''}}</span></p>
                                <p class="invoice-info-row"><span>Company</span> <span>{{$ticket->policy->company->name ?? ''}}</span></p>
                                <p class="invoice-info-row"><span>Holder name</span> <span>{{$ticket->policy->holder_name ?? ''}}</span></p>
                                <p class="invoice-info-row"><span>Email</span> <span>{{$ticket->policy->email ?? ''}}</span></p>
                                
                            </div>
                            <div class="col-lg-6">

                            <label class="tx-gray-600"></label>

                                <p class="invoice-info-row"><span>Status</span> <span style="font-size: large;">{{$ticket->status ?? ''}}</span></p>
                                <p class="invoice-info-row"><span>Current Value</span> <span>{{$ticket->current_value ?? ''}}</span></p>
                                <p class="invoice-info-row"><span>New Value:</span> <span>{{$ticket->new_value ??''}}</span></p>
                                <p class="invoice-info-row"><span>Created by</span> <span>{{$ticket->user->name ??''}} ({{$ticket->user->email ?? ''}})</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <h5>Remarks details</h5>
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">Remarks</th>
                                        <th class="wd-40p">Created By</th>
                                        <th class="wd-40p">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($ticket->remarkDetails->count())
                                    @foreach($ticket->remarkDetails as $remark)
                                    <tr>
                                        <td>{{$remark->remark}}</td>
                                        <td>{{$remark->user->name ?? ''}}</td>
                                        <td>{{$remark->created_at}}</td>

                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <h5>Attachment details</h5>
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">File</th>
                                        <th class="wd-40p">Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($ticket->attachments->count())
                                    @foreach($ticket->attachments as $attachment)
                                    <tr>
                                        <td><a href="{{asset('attachments/'.$attachment->file)}}" target="_blank">{{$attachment->file}}</a></td>
                                        <td>{{$attachment->user->name ?? ''}}</td>

                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
</div>


<!-- attachment effects -->
<div class="modal fade" id="attachments">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Update</h6><button aria-label="Close" class="close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('ticket.update',$ticket->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="row">

                        <div class="col-lg-12">
                            <h6>Remark</h6>
                            <textarea name="remark" id="remark" class="form-control" ></textarea>
                        </div>
                        <div class="col-lg-12">
                            <h6>Status</h6>
                            <select name="status" id="status" class="form-control" >
                                <option value="">Select Status</option>
                                <option value="assigned" @if($ticket->status == 'assigned') selected @endif
                                    >assigned</option>
                                <option value="in progress" @if($ticket->status == 'in progress') selected @endif
                                    >in progress</option>
                                <option value="more info" @if($ticket->status == 'more info') selected @endif
                                    >more info</option>
                                <option value="done" @if($ticket->status == 'done') selected @endif
                                    >done</option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <h6>Attachment</h6>
                            <input type="file" name="attachment[]" class="form-control" multiple>
                        </div>

                    </div>


                    <input type="hidden" name="ticket_id" value="{{$ticket->id ?? ''}}">
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary save-status" type="submit">Save changes</button>
                    <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->
@endsection


@section('scripts')


@endsection