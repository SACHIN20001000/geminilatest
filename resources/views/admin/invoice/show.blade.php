@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-center">PAYOUT REPORT</h1>


    <div class="row mt-4">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>MONTH</th>
                    <td>{{$invoice->invoice_date ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th>REFERENCE NAME</th>
                    <td>{{$invoice->users->name ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th>Bank Detail</th>
                    <td>{{$invoice->users->bank_name ?? 'N/A'}}</td>
                <tr>
                    <th>A/C NAME</th>
                    <td>{{$invoice->name ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th>A/C NO</th>
                    <td>{{$invoice->bank_detail ?? 'N/A'}}</td>
                </tr>
                <tr>
                    <th>IFSC CODE</th>
                    <td>{{$invoice->users->ifsc ?? 'N/A'}}</td>
                </tr>
            </table>
        </div>

        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>TOTAL PAYOUT</th>
                    <td>{{$invoice->total_Payout}}</td>
                </tr>
                <tr>
                    <th>SHORT PREMIUM AMOUNT</th>
                    <td>{{$invoice->short_premium}}</td>
                </tr>
                <tr>
                    <th>RECOVERY</th>
                    <td>{{$invoice->recovery_cases}}</td>
                </tr>
                <tr>
                    <th>GROSS AMOUNT</th>
                    <td>{{$invoice->amount_transfer}}</td>
                </tr>
                <tr>
                    <th>TDS%</th>
                    <td>{{$invoice->tds}}</td>
                </tr>
                <tr>
                    <th>NET AMOUNT</th>
                    <td>{{$invoice->invoice_amount}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row row-sm">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
            <div class="card">

                <div class="card-body">
                    <h3 class="mt-4">Policies</h3>
                    <div class="table-responsive border-top userlist-table">

                        <table id="policies-table" class="card-table table-striped table-vcenter  mb-0">
                            <thead>
                                <tr>
                                    <th>POLICY HOLDER NAME</th>
                                    <th>TRANSACTION TYPE</th>
                                    <th>TYPE OF BUSINESS</th>
                                    <th>SUB PRODUCT</th>
                                    <th>MODEL</th>
                                    <th>VEH NO</th>
                                    <th>GROSS PREMIUM</th>
                                    <th>NET PREMIUM</th>
                                    <th>OD PREMIUM</th>
                                    <th>PREMIUM SHORT</th>
                                    <th>COMMISSION BASE</th>
                                    <th>BASE AMOUNT</th>
                                    <th>PAYOUT %GE</th>
                                    <th>PAYOUT</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($invoice->policy->count())
                                @foreach($invoice->policy as $policy)
                                <tr>
                                    <td>{{$policy->holder_name}}</td>
                                    <td>{{$policy->mis_transaction_type}}</td>
                                    <td>{{$policy->bussiness_type}}</td>
                                    <td>{{$policy->subProduct->name ?? ''}}</td>
                                    <td>{{$policy->models->name ?? ''}}</td>
                                    <td>{{$policy->reg_no}}</td>
                                    <td>{{$policy->gross_premium}}</td>
                                    <td>{{$policy->net_premium}}</td>
                                    <td>{{$policy->od_premium}}</td>
                                    <td>{{$policy->mis_short_premium}}</td>
                                    <td>{{$policy->commission_base}}</td>
                                    <td>{{$policy->mis_commissionable_amount}}</td>
                                    <td>{{$policy->mis_percentage}}</td>
                                    <td>{{$policy->mis_commission}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#policies-table').DataTable();
    });
</script>

@endsection