<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Policy;
class IncomeController extends Controller
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
            $data = Policy::with('company','lead','subProduct')->whereNotNull('channel_name')->orderby('channel_name','asc')->get();

            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('company', function ($row)
                            {
                                return isset($row->company->name)?  $row->company->name : '';
                            })
                            ->addColumn('subProduct', function ($row)
                            {
                                return isset($row->subProduct->name)?  $row->subProduct->name : '';
                            })
                            ->addColumn('lead', function ($row)
                            {
                                return isset($row->lead->holder_name)?  $row->lead->holder_name : $row->holder_name;
                            })
                            ->make(true) ;
        }
        return view('admin.income.index');
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
