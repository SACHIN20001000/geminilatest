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
                ->make(true);
        }
        return view('admin.invoice.index');
    }
}
