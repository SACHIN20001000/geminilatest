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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExportController extends Controller
{
  public function policyView()
  {
    return view('admin.export.policy');
  }
  public function vecialView()
  {
    return view('admin.export.vecial');
  }
  public function exportPolicy(Request $request)
  {
    /*data to add the*/
    if ($request->file('policy')) {
      $path = $request->file('policy')->getRealPath();  /// DEFINE FILE PATH HERE///

      //turn into array
      $file = file($path);

      $header = array_slice($file, 0, 1);

      if (!empty($header)) {
        foreach ($header as $head) {
          $headerQuotes = str_replace('"', '', trim(strtolower($head)));

          $headerF = explode(',', str_replace(' ', '_', trim(strtolower($headerQuotes))));
        }
      }
      $csvdata = array_slice($file, 1);
      $requiredHeaders = [
        'created_date', 'channel_name', 'reference', 'reference_contact_no', 'email',
        'insurance_company', 'customer_name', 'policy_no', 'policy_type', 'start_date',
        'end_date', 'product', 'sub_product', 'make', 'model', 'veichel_cc', 'mfr_year',
        'veh_no', 'idv', 'ncb', 'gwp', 'net_premiun', 'tp_premium', 'od_premium',
        'premium_received', 'payment_mode', 'remarks', 'status', 'premium_amount_received',
        'payment_date'
      ];
      if (!empty($csvdata)) {
        if (count(array_intersect($requiredHeaders, $headerF)) == count($requiredHeaders)) {

          foreach ($csvdata as $key => $csv) {
            $csvArrF = explode(",", trim(strtolower($csv)));
            if (count($csvArrF) === count($headerF)) {


              $finalCsvData[] = array_combine($headerF, $csvArrF);
            }
          }

        
          foreach ($finalCsvData as $key => $finalCsv) {

            $newDate = date("d-m-Y H:i:s", strtotime($finalCsv['created_date']));
            try {
              DB::beginTransaction();

              $user = User::where('phone', trim($finalCsv['reference_contact_no']))->first();
              $insurance_company = Company::where('name', 'like', '%' . $finalCsv['insurance_company'] . '%')->first();
              $product = Product::where('name', 'like', '%' . $finalCsv['product'] . '%')->first();
              $sub_product = SubProduct::where('name', 'like', '%' . $finalCsv['sub_product'] . '%')->first();
              $make = Make::where('name', 'like', '%' . $finalCsv['make'] . '%')->first();
              $model = ModelMake::where('name', 'like', '%' . $finalCsv['model'] . '%')->first();
              $channel_name = Channel::where('name', 'like', '%' . $finalCsv['channel_name'] . '%')->first();
              $cleanPolicyNo = $finalCsv['policy_no'] ? preg_replace('/[^\p{L}\p{N}]/u', '/', $finalCsv['policy_no']) : null;
              $cleanHolderName = $finalCsv['customer_name'] ? preg_replace('/[^\p{L}\p{N}\s]/u', '', $finalCsv['customer_name']) : null;
            
              $finalArr = [
                'user_id' => $user->id ?? null,
                'holder_name' =>  $cleanHolderName ?? null,
                'phone' => $finalCsv['reference_contact_no'] ?? null,
                'email' => $finalCsv['email'] ?? null,
                'user_type' => $user->roles[0]->id ?? null,
                'insurance_id' => $product->insurances->id ?? null,
                'product_id' => $product->id ?? null,
                'subproduct_id' => $sub_product->id ?? null,
                'company_id' => $insurance_company->id ?? null,
                'channel_name' => $channel_name->name ?? null,
                'is_policy' => 1 ?? null,
                'mis_payment_method' => $finalCsv['payment_mode'] ?? null,
                'start_date' => date("Y-m-d", strtotime($finalCsv['start_date'])) ?? null,
                'expiry_date' => date("Y-m-d", strtotime($finalCsv['end_date'])) ?? null,
                'policy_no' => $cleanPolicyNo,
                'mis_transaction_type' => $finalCsv['policy_type'] ?? null,
                'make' => $make->id ?? null,
                'model' => $model->id ?? null,
                'cc' => $finalCsv['veichel_cc'] ?? null,
                'mfr_year' => $finalCsv['mfr_year'] ?? null,
                'reg_no' => $finalCsv['veh_no'] ?? null,
                'ncb_in_existing_policy' => $finalCsv['ncb'] ?? null,
                'gwp' => $finalCsv['gwp'] ?? null,
                'gross_premium' => $finalCsv['gwp'] ?? null,
                'net_premium' => $finalCsv['net_premiun'] ?? null,
                'tp_premium' => $finalCsv['tp_premium'] ?? null,
                'od_premium' => $finalCsv['od_premium'] ?? null,
                'remarks' => $finalCsv['remarks'] ?? null,
                'mis_amount_paid' => $finalCsv['premium_amount_received'] ?? null,
                'mis_payment_date' => $finalCsv['payment_date'] ?? null,
                'created_at' => $newDate ?? null

              ];

              Policy::create($finalArr);
              DB::commit();
            } catch (\Exception $e) {
              
              echo $e->getMessage();
              die;
              DB::rollback();
              return back()->with('error', 'Error: ' . $e->getMessage());
            }
          }
          return back()->with('success', 'Policy Imported successfully!');
        }
        return back()->with('error', 'Error, Missing or Invalid Headers in the file!');
      }
    }

    return back()->with('error', 'Error, Please upload the file!');
  }
  public function exportVecial(Request $request)
  {
    /*data to add the*/
    if ($request->file('vecial')) {
      $path = $request->file('vecial')->getRealPath();  /// DEFINE FILE PATH HERE///

      //turn into array
      $file = file($path);

      $header = array_slice($file, 0, 1);

      if (!empty($header)) {
        foreach ($header as $head) {
          $headerQuotes = str_replace('"', '', trim(strtolower($head)));

          $headerF = explode(',', str_replace(' ', '_', trim(strtolower($headerQuotes))));
        }
      }
      $csvdata = array_slice($file, 1);

      if (!empty($csvdata)) {

        if (
          in_array('manufacture', $headerF) && in_array('model', $headerF) && in_array('variant', $headerF) && in_array('fuel', $headerF) && in_array('cc', $headerF) && in_array('seating', $headerF) && in_array('showroom', $headerF) && in_array('tp', $headerF) && in_array('od', $headerF)
        ) {
          foreach ($csvdata as $key => $csv) {
            $csvArrF = explode(",", trim($csv));

            $finalCsvData[] = array_combine($headerF, $csvArrF);
          }

          foreach ($finalCsvData as $key => $finalCsv) {

            try {
              $make = Make::updateOrCreate([
                'name' => $finalCsv['manufacture']
              ]);
              $model = ModelMake::updateOrCreate([
                'name' => $finalCsv['model'],
                'make_id' => $make->id
              ]);
              if (isset($finalCsv['variant']) && !empty($finalCsv['variant'])) {
                MakeModel::updateOrCreate([
                  'make_id' => $model->id,
                  'name' => $finalCsv['variant'],
                  'type' => 'varriant'
                ]);
              }
              if (isset($finalCsv['fuel']) && !empty($finalCsv['fuel'])) {
                MakeModel::updateOrCreate([
                  'make_id' => $model->id,
                  'name' => $finalCsv['fuel'],
                  'type' => 'fuel'
                ]);
              }
              if (isset($finalCsv['cc']) && !empty($finalCsv['cc'])) {
                MakeModel::updateOrCreate([
                  'make_id' => $model->id,
                  'name' => $finalCsv['cc'],
                  'type' => 'cc'
                ]);
              }
              if (isset($finalCsv['seating']) && !empty($finalCsv['seating'])) {
                MakeModel::updateOrCreate([
                  'make_id' => $model->id,
                  'name' => $finalCsv['seating'],
                  'type' => 'seating'
                ]);
              }
              if (isset($finalCsv['showroom']) && !empty($finalCsv['showroom'])) {
                MakeModel::updateOrCreate([
                  'make_id' => $model->id,
                  'name' => $finalCsv['showroom'],
                  'type' => 'showroom'
                ]);
              }
              if (isset($finalCsv['tp']) && !empty($finalCsv['tp'])) {
                MakeModel::updateOrCreate([
                  'make_id' => $model->id,
                  'name' => $finalCsv['tp'],
                  'type' => 'tp'
                ]);
              }
              if (isset($finalCsv['od']) && !empty($finalCsv['od'])) {
                MakeModel::updateOrCreate([
                  'make_id' => $model->id,
                  'name' => $finalCsv['od'],
                  'type' => 'od'
                ]);
              }
            } catch (\Exception $e) {
            }
          }
          return back()->with('success', 'File Imported successfully!');
        }
        return back()->with('error', 'Error, Please Check the file!');
      }
    }

    return back()->with('error', 'Error, Please upload the file!');
  }
}
