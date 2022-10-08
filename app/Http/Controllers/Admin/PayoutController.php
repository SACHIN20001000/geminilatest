<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Policy;
use DataTables;
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
            $data = Policy::with('users','clients','insurances','company','products','subProduct')->where('is_mis',1)->orderby('id','DESC')->get();
            return Datatables::of($data)
                            ->addIndexColumn()
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
                            ->make(true);
        }
        return view('admin.payout.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
