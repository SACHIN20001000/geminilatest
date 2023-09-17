<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
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
                    $btn = '<a href="' . route('invoice.show', $row->id) . '" class="edit btn btn-primary btn-sm">View</a>';
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

    public function downloadInvoice($id){
        // $invoice = Invoice::with('users')->find($id);

        // $pdf = \PDF::loadView('admin.invoice.show', compact('invoice'));
        // return $pdf->download('invoice.pdf');
    }
}
