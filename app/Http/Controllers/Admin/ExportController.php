<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\SubProduct;
use App\Models\Channel;
use App\Models\MakeModel;
use App\Models\ModelMake;
use App\Models\Make;
use App\Models\Policy;
use App\Models\Insurance;
use App\Models\Company;
use App\Models\Attachment; 
class ExportController extends Controller
{
    public function policyView(){
        return view('admin.export.policy');
    }
    public function exportPolicy(Request $request){
           /*data to add the*/
           $path = $request->file('policy')->getRealPath();  /// DEFINE FILE PATH HERE///

           //turn into array
           $file = file($path);
   
           $header = array_slice($file,0,1);
          
           if(!empty($header))
           {
             foreach($header as $head)
             {
               $headerQuotes= str_replace('"', '', trim(strtolower($head)));
   
               $headerF=explode(',', str_replace(' ', '_', trim(strtolower($headerQuotes))));
             }
   
           }
           $csvdata = array_slice($file,1);
           if(!empty($csvdata))
           {
             if(in_array('created_date', $headerF) && in_array('channel_name', $headerF) && in_array('reference', $headerF) && in_array('reference_contact_no', $headerF) && in_array('email', $headerF) && in_array('insurance_company', $headerF) && in_array('customer_name', $headerF) && in_array('policy_no', $headerF) && in_array('policy_type', $headerF) && in_array('start_date', $headerF) && in_array('end_date', $headerF) && in_array('product', $headerF) && in_array('sub_product', $headerF) && in_array('make', $headerF) && in_array('model', $headerF) && in_array('veichel_cc', $headerF) && in_array('mfr_year', $headerF) && in_array('veh_no', $headerF)   && in_array('idv', $headerF) && in_array('ncb', $headerF) && in_array('gwp', $headerF) && in_array('net_premiun', $headerF) && in_array('tp_premium', $headerF) && in_array('od_premium', $headerF) && in_array('premium_received', $headerF)  && in_array('payment_mode', $headerF) && in_array('remarks', $headerF) && in_array('status', $headerF)  && in_array('premium_amount_received', $headerF)  && in_array('payment_date', $headerF)  
             )
             {
              foreach($csvdata as $key=>$csv)
            {
              $csvArrF=explode(",",trim(strtolower($csv)));

              $finalCsvData[]=array_combine($headerF, $csvArrF);
            }
            foreach ($finalCsvData as $key => $finalCsv) {
              $newDate = date("d-m-Y h:m:s", strtotime($finalCsv['created_date']));
             try {
              $user= User::where('name', 'like', '%'.$finalCsv['reference'].'%')->first();
              $insurance_company= Company::where('name', 'like', '%'.$finalCsv['insurance_company'].'%')->first();
              $product= Product::where('name', 'like', '%'.$finalCsv['product'].'%')->first();
              $sub_product= SubProduct::where('name', 'like', '%'.$finalCsv['sub_product'].'%')->first();
              $make= Make::where('name', 'like', '%'.$finalCsv['make'].'%')->first();
              $model= ModelMake::where('name', 'like', '%'.$finalCsv['model'].'%')->first();
              $channel_name= Channel::where('name', 'like', '%'.$finalCsv['channel_name'].'%')->first();

              $finalArr=[
                'user_id'=> $user->id ?? null,
                'holder_name'=> $finalCsv['customer_name'] ?? null,
                'phone'=> $finalCsv['reference_contact_no'] ?? null,
                'email'=> $finalCsv['email'] ?? null,
                'user_type'=> $user->roles[0]->id ?? null,
                'insurance_id'=> $product->insurances->id ?? null,
                'product_id'=> $product->id ?? null,
                'subproduct_id'=> $sub_product->id ?? null,
                'company_id'=> $insurance_company->id ?? null,
                'company_id'=> $insurance_company->id ?? null,
                'is_policy'=> 1 ?? null,
                'mis_payment_method'=> $finalCsv['payment_mode'] ?? null,
                'mis_payment_method'=> $finalCsv['payment_mode'] ?? null,
                'start_date'=> $finalCsv['start_date'] ?? null,
                'end_date'=> $finalCsv['end_date'] ?? null,
                'policy_no'=> $finalCsv['policy_no'] ?? null,
                'mis_transaction_type'=> $finalCsv['policy_type'] ?? null,
                'make'=> $make->id ?? null,
                'model'=> $model->id ?? null,
                'cc'=> $finalCsv['veichel_cc'] ?? null,
                'mfr_year'=> $finalCsv['mfr_year'] ?? null,
                'reg_no'=> $finalCsv['veh_no'] ?? null,
                'ncb_in_existing_policy'=> $finalCsv['ncb'] ?? null,
                'gwp'=> $finalCsv['gwp'] ?? null,
                'gross_premium'=> $finalCsv['gwp'] ?? null,
                'net_premium'=> $finalCsv['net_premium'] ?? null,
                'tp_premium'=> $finalCsv['tp_premium'] ?? null,
                'od_premium'=> $finalCsv['od_premium'] ?? null,
                'remarks'=> $finalCsv['remarks'] ?? null,
                'mis_amount_paid'=> $finalCsv['premium_amount_received'] ?? null,
                'mis_payment_date'=> $finalCsv['payment_date'] ?? null,
                'created_at'=>$newDate ?? null

              ];
             
              Policy::create($finalArr);
             } catch (\Exception $e) {
              
             }
             
              
            }
              return back()->with('success', 'Policy Imported successfully!');
           
             }
             return back()->with('error', 'Error, Please Check the file!');
            }
           
        }
}
