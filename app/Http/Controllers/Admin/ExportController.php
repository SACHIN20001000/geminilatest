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
use App\Models\ErrorFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ExportController extends Controller
{
  public function policyView()
  {
    $errorFile = ErrorFile::all();
    return view('admin.export.policy', compact('errorFile'));
  }
  public function vecialView()
  {
    return view('admin.export.vecial');
  }
  public function importUserView()
  {
    return view('admin.export.import_user');
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
      $errorData = [];
      if (!empty($csvdata)) {
        if (count(array_intersect($requiredHeaders, $headerF)) == count($requiredHeaders)) {

          foreach ($csvdata as $key => $csv) {
            $csvArrF = explode(",", trim(strtolower($csv)));
            if (count($csvArrF) === count($headerF)) {


              $finalCsvData[] = array_combine($headerF, $csvArrF);
            } else {
              $errorData[] = $csvArrF;
            }
          }

          if (!empty($errorData)) {

            $csvData = '';
            foreach ($errorData as $row) {
              $csvData .= implode(',', $row) . "\n";
            }

            $publicPdfDirectory = public_path('error');
            $pdfPath = public_path('error/file' . rand(1000, 9999) . '.csv');

            if (!File::exists($publicPdfDirectory)) {
              File::makeDirectory($publicPdfDirectory, 0755, true);
            }
            file_put_contents($pdfPath, $csvData);
            $filename = basename($pdfPath); // Extracting just the filename from the path

            ErrorFile::create([
              'file_name' => $filename
            ]);
          }


          foreach ($finalCsvData as $key => $finalCsv) {

            $newDate = date("d-m-Y H:i:s", strtotime($finalCsv['created_date']));
            try {
              DB::beginTransaction();

              $user = User::where('phone', 'like', '%' . trim($finalCsv['reference_contact_no']) . '%')->first();
              $insurance_company = Company::where('name', 'like', '%' . $finalCsv['insurance_company'] . '%')->first();
              $product = Product::where('name', 'like', '%' . $finalCsv['product'] . '%')->first();
              $sub_product = SubProduct::where('name', 'like', '%' . $finalCsv['sub_product'] . '%')->first();
              $make = Make::where('name', 'like', '%' . $finalCsv['make'] . '%')->first();
              $model = ModelMake::where('name', 'like', '%' . $finalCsv['model'] . '%')->first();
              $channel_name = Channel::where('name', 'like', '%' . $finalCsv['channel_name'] . '%')->first();
              $cleanPolicyNo = $finalCsv['policy_no'] ? preg_replace('/[^\p{L}\p{N}]/u', '/', $finalCsv['policy_no']) : null;
              $cleanHolderName = $finalCsv['customer_name'] ? preg_replace('/[^\p{L}\p{N}\s]/u', '', $finalCsv['customer_name']) : null;
              $cleanRegNo = $finalCsv['veh_no'] ? preg_replace('/[^\p{L}\p{N}]/u', '', $finalCsv['veh_no']) : null;

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
                'reg_no' => $cleanRegNo ?? null,
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

              Policy::updateOrCreate(
                ['policy_no' => $cleanPolicyNo],
                $finalArr
              );
              DB::commit();
            } catch (\Exception $e) {
              echo "Error processing record: " . $e->getMessage() . "<br>";
              DB::rollback();
              return back()->with('error', 'Error: ' . $e->getMessage());
            }
          }
          $errors = ob_get_clean();
          if (empty($errors)) {
            return back()->with('success', 'Policy Imported successfully!');
          } else {
            return back()->with('error', 'Error: ' . $errors);
          }
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

  public  function importUsers(Request $request)
  {

    /*data to add the*/
    if ($request->file('users')) {
      $path = $request->file('users')->getRealPath();  /// DEFINE FILE PATH HERE///

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
          in_array('name', $headerF) && in_array('phone', $headerF) && in_array('email', $headerF) && in_array('role', $headerF) && in_array('upi', $headerF) && in_array('birthday', $headerF) && in_array('account_no', $headerF) && in_array('bank_name', $headerF) && in_array('account_name', $headerF) && in_array(
            'ifsc',
            $headerF
          )
        ) {
          $errorMessages = [];
          foreach ($csvdata as $key => $csv) {
            $csvArrF = explode(",", trim($csv));

            if (count($csvArrF) == count($headerF)) {

              $finalCsvData[] = array_combine($headerF, $csvArrF);
            }
          }


          foreach ($finalCsvData as $key => $finalCsv) {
            if (!in_array($finalCsv['role'], ['Staff', 'Broker', 'Client'])) {
              $errorMessages[] = "Error in row $key: Invalid role specified in the CSV file! Name = " . $finalCsv['name'] . ", Role = " . $finalCsv['role'] . "  
                Role should be Staff, Broker,Client.";
            }

            try {
              DB::beginTransaction();


              $user = User::updateOrCreate([
                'email' => $finalCsv['email'],
              ], [
                'name' => $finalCsv['name'],
                'upi' => $finalCsv['upi'],
                'birthday' => $finalCsv['birthday'],
                'account_no' => $finalCsv['account_no'],
                'bank_name' => $finalCsv['bank_name'],
                'account_name' => $finalCsv['account_name'],
                'ifsc' => $finalCsv['ifsc'],
                'password' => bcrypt('12345678'),
              ]);
              $user->syncRoles([$finalCsv['role']]);
              DB::commit();
            } catch (\Exception $e) {


              DB::rollback();
              $errorMessages[] = "Error in row $key: " . $e->getMessage();
            }
          }

          if (!empty($errorMessages)) {
            // Display error messages
            return back()->with('error', implode('<br>', $errorMessages));
          }
          return back()->with('success', 'File Imported successfully!');
        }
        return back()->with('error', 'Error, Please Check the file!');
      }
    }

    return back()->with('error', 'Error, Please upload the file!');
  }
}
