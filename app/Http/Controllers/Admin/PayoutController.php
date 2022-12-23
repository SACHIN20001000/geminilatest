<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Policy;
use App\Models\Invoice;
use App\Models\User;
use DataTables;
use DB;
class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
        if ($request->ajax())
        {
           
            $query = Policy::with('users','clients','insurances','company','products','subProduct')->where('is_mis',1);
            if(isset($request->id) && !empty($request->id)) {
                $query->where('user_id',$request->id);
               
            }
            if(!empty($request->from) && !empty($request->to)){
                $query->whereBetween('expiry_date', [$request->from,$request->to]);
               }
            $data=  $query->orderby('id','DESC')->get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('checkbox', function ($row)
                            {
                                $action = '<input type="checkbox" name="checked"  class="checkSingle" value="'.$row->id.'"> 
                    ';
                                return $action;
                            })
                            ->addColumn('recovery', function ($row)
                            {
                                if($row->is_recovery == 0){

                                    $action = '<select name="is_recovery" data-id="'.$row->id.'" class="is_recovery form-control">
                                    <option value="0" selected >No</option>
                                    <option value="1" >Yes</option>
                                    </select>';                              
                                }else{
                                    $action = '<select name="is_recovery" data-id="'.$row->id.'" class="is_recovery form-control">
                                    <option value="0"  >No</option>
                                    <option value="1" selected >Yes</option>
                                    </select>';      
                                }
                                
                                return $action;
                            })
                            ->addColumn('clients', function ($row)
                            {
                                return isset($row->clients->name)?  $row->clients->name : '';
                            })
                            ->addColumn('company', function ($row)
                            {
                                return isset($row->company->name)?  $row->company->name : '';
                            })
                            ->addColumn('subproduct', function ($row)
                            {
                                return isset($row->subProduct->name)?  $row->subProduct->name : '';
                            })
                            ->addColumn('invoiced', function ($row)
                            {
                                return '<div  data-id="'.$row->invoice_id.'" class="get-invoice">'.$row->invoice_id.' </div>';
                            })
                            ->rawColumns(['checkbox','recovery','invoiced'])
                            ->make(true);
        }
        return view('admin.payout.index');
    }

    public function brokerPayout(Request $request){
    
     
        if ($request->ajax())
        {
            $query = User::has('policy');
            $data= $query->orderby('id','DESC')->get();
          
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function ($row ,Request $request)
                            {
                              $array=[
                                'id'=>$row,
                                'status'=> $request->status??'',
                                'from'=> $request->from ??'',
                                'to'=> $request->to??'',
                              ];
                                
                                $action = '<span class="action-buttons">
                                
                        <a  href="' . route("payout.index", $array) . '" class="btn btn-sm btn-info btn-b"><i class="fa fa-eye"></i>
                        </a>
                    ';
                                return $action;
                            })
                            ->addColumn('payable', function ($row,Request $request)
                            {
                                $query= Policy::where(['user_id'=>$row->id]);
                                 if(!empty($request->from) && !empty($request->to)){
                                  $query->whereBetween('expiry_date', [$request->from,$request->to]);
                                 }
                               $receivable =$query->sum('mis_amount_paid');
                               
                                $pay=!empty($row->advance_payout)?$row->advance_payout:0;
                                $action = '<span class="">'.$pay.'</span>/<span class="">'.$receivable.'</span>    ';
                                return $action;
                            })
                            ->rawColumns(['action','payable'])
                            ->make(true);
        }
        return view('admin.payout.userpayout');
        
    }
    public function getInvoiceDetail(Request $request){
          
            $policy=Policy::select('mis_premium','mis_amount_paid','user_id')->whereIn('id',$request->ids)->get();
            $recovery_cases=Policy::whereIn('id',$request->ids)->where(['is_recovery'=>1])->count();
          $short_premium=0;
          $total_Payout=0;
            if($policy->count()){
                foreach ($policy as $key => $value) {
                  $short_premium +=$value->mis_amount_paid;
                  $total_Payout +=$value->mis_premium;
                }
            }
           $user= User::find($request->user_id);
           $response=[];
           $response['advance_payout']= $user->advance_payout;
           $response['short_premium']= $short_premium;
           $response['total_Payout']= $total_Payout;
           $response['recovery_cases']= $recovery_cases;
           return $response;
    }
    public function invoiceStore(Request $request){
       
     $invoice=   Invoice::create([
            'user_id'=>$request->user_id,
            'invoice_id'=>random_int(1000, 9999),
            'invoice_date'=>$request->invoice_date,
            'transfer_date'=>$request->transfer_date,
            'bank_detail'=>$request->bank_detail,
            'name'=>$request->name,
            'invoice_amount'=>$request->invoice_amount,
            'tds'=>$request->tds,
            'amount_transfer'=>$request->amount_transfer,
            'adjusted'=>$request->adjusted,
            'advance_payout'=>$request->advance_payout,
            'recovery_cases'=>$request->recovery_cases,
            'short_premium'=>$request->short_premium,
            'total_Payout'=>$request->total_Payout,
     ]);
    $user= User::find($request->user_id);
    if(!empty($user->advance_payout)){
        $amount = $user->advance_payout - $request->invoice_amount;
        $user->update(['advance_payout'=> $amount]);
    }
    Policy::whereIn('id',$request->policy_id)->update(['invoice_id'=>$invoice->invoice_id]);
    return back()->with('success', 'Invoice Generated successfully!');
    }
  public function getStatusChange(Request $request){
    Policy::find($request->id)->update(['is_recovery'=>$request->value]);

  }
  public function getInvoice(Request $request){
    $invoice=Invoice::where('invoice_id',$request->id)->first();
    return $invoice;
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function download(){
        $file= public_path(). "/csv/samplePolicy.csv";
       
    $headers = array(
              'Content-Type: application/csv',
            );

    return \Response::download($file, 'samplePolicy.csv', $headers);
    }
    public function downloadsampleVeichel(){
        $file= public_path(). "/csv/sampleVeichel.csv";
       
    $headers = array(
              'Content-Type: application/csv',
            );

    return \Response::download($file, 'sampleVeichel.csv', $headers);
    }
}
