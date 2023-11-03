<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Policy;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $query = Invoice::query();
            $query->with('users');
            $data = $query
                ->where('status', 'pending') // Filter invoices with 'pending' status
                ->orderBy('id', 'DESC')
                ->get();
            // Filter users where totalAmount is greater than 0

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr;">
                    <a href="' . route('invoice.show', $row->id) . '" class="edit btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View Invoice">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <a href="' . route('invoice.edit', $row->id) . '" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Sync Invoice">
                        <i class="zmdi zmdi-refresh-alt" aria-label="zmdi zmdi-refresh-alt"></i>
                    </a>
                    <a href="' . route("invoice.changeStatus", $row) . '" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Verified Invoice" data-method="DELETE" data-confirm-title="Please Confirm" data-confirm-text="Are you sure that you want to verify this invoice?" data-confirm-delete="Yes, verify it!">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </a>
                    <a href="' . route("invoice.destroy", $row) . '"
                    class="btn btn-sm btn-danger"
                    title="Delete Invoice"
                    data-toggle="tooltip"
                    data-placement="top"
                    data-method="DELETE"
                    data-confirm-title="Please Confirm"
                    data-confirm-text="Are you sure that you want to delete this Invoice?"
                    data-confirm-delete="Yes, delete it!">
                    <i class="las la-trash"></i>
                </a>
                </div>
                ';
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

    public function edit($id)

    {
        $invoice = Invoice::with('users')->find($id);
        $policy = Policy::where('invoice_id', $invoice->id)->get();
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
    public function downloadInvoice($id)
    {
        // $invoice = Invoice::with('users')->find($id);

        // $pdf = \PDF::loadView('admin.invoice.show', compact('invoice'));
        // return $pdf->download('invoice.pdf');
    }

    public function verifiedInvoice(Request $request)
    {

        if ($request->ajax()) {

            $query = Invoice::with('users')
                ->where('status', 'verified')
                ->orderBy('id', 'DESC');

            $payment_status = [
                1 => 'pending',
                2 => 'paid',
                3 => 'canceled',
            ];

            if(isset($request->date) && !empty($request->date)){
                $query->whereDate('created_at', today());
            }
            $data = $query->where('payment_status', $payment_status[$request->id] ?? 'pending')->get();


            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div style="display: grid; grid-template-columns: 1fr 1fr;"><a href="' . route('invoice.show', $row->id) . '" class="edit btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="View Invoice">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </a> <a href="#" class="change-status-icon btn btn-info btn-sm" data-toggle="modal" data-target="#changePaymentStatusModal" data-id="' . $row->id . '">
                <i class="fa fa-edit" aria-hidden="true"></i>
            </a></div>';
                    return $btn;
                })
                ->make(true);
        }
        return view('admin.invoice.verified');
    }
    public function changeStatus($id)
    {

        $invoice = Invoice::find($id);
        $invoice->update([
            'status' => 'verified',
        ]);
        
        return redirect()->route('invoice.verified', ['id' => 1])->with('success', 'Invoice Verified Successfully');
    }

    public function updatePaymentStatus(Request $request)
    {
        $invoice = Invoice::find($request->invoice_id);
        $invoice->update([
            'payment_status' => $request->new_status,
        ]);
        return response()->json(['success' => true, 'message' => 'Status Updated Successfully']);
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        Policy::where('invoice_id', $invoice->id)->update([
            'invoice_id' => null,
        ]);
        
        $invoice->delete();
        return redirect()->route('invoice')->with('success', 'Invoice Deleted Successfully');
    }
}
