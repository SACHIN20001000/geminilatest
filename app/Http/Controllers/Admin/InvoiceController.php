<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Policy;
use Illuminate\Http\Request;
use DataTables;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $query = Invoice::query();
            $query->with('users');
            $data = $query
                ->orderBy('id', 'DESC')
                ->get();
            // Filter users where totalAmount is greater than 0
         
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('invoice.show', $row->id) . '" class="edit btn btn-primary btn-sm">View</a><a href="' . route('invoice.edit', $row->id) . '" class=" btn btn-success btn-sm">Sync</a>';
                    return $btn;
                })
                ->make(true);
        }
        return view('admin.invoice.index');
    }

    public function show($id)
    {
        $invoice = Invoice::with('users')->find($id);
        return view('admin.invoice.show', compact('invoice'));
    }

    public function edit( $id)

    {
        $invoice = Invoice::with('users')->find($id);
        $policy= Policy::where('invoice_id', $invoice->id)->get();
        $totalAmount = $policy->sum('mis_commission') - $policy->sum('mis_short_premium') - $policy->sum('payout_recovery');
        $tdsPercentage = $invoice->users->tds_percentage ?? 0; // Default to 0 if tds_percentage is not set
        $invoiceAmount = $totalAmount * (1 - ($tdsPercentage / 100));

        $invoice->update([
            'user_id' => $invoice->users->id,
            'invoice_id' => random_int(1000, 9999),
            'invoice_date' => now(),
            'transfer_date' => now(),
            'bank_detail' => $invoice->users->account_no ?? 'N/A',
            'name' => $invoice->users->account_name ?? 'N/A',
            'invoice_amount' => $invoiceAmount,
            'tds' => $invoice->users->tds_percentage ?? 0,
            'amount_transfer' => $totalAmount,
            'adjusted' => 'N/A',
            'advance_payout' => $invoice->users->advance_payout,
            'recovery_cases' => $policy->sum('payout_recovery'),
            'short_premium' => $policy->sum('mis_short_premium'),
            'total_Payout' => $policy->sum('mis_commission'),
        ]);
    
        return redirect()->route('invoice')->with('success', 'Invoice Synced Successfully');
       
    
    }
    public function downloadInvoice($id){
        // $invoice = Invoice::with('users')->find($id);

        // $pdf = \PDF::loadView('admin.invoice.show', compact('invoice'));
        // return $pdf->download('invoice.pdf');
    }
}
