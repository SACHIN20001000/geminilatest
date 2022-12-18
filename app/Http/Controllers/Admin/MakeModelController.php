<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Make;
use App\Models\SubProduct;

use DataTables;
use App\Http\Requests\Admin\Make\StoreModelRequest;

class MakeModelController extends Controller
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
            $data = Make::orderby('id','DESC')->get();

            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function ($row)
                            {
                                $action = '<span class="action-buttons">
                                
                        <a  href="' . route("make.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                        </a>

                        <a href="' . route("make.destroy", $row) . '"
                                class="btn btn-sm btn-danger remove_us"
                                title="Delete User"
                                data-toggle="tooltip"
                                data-placement="top"
                                data-method="DELETE"
                                data-confirm-title="Please Confirm"
                                data-confirm-text="Are you sure that you want to delete this User?"
                                data-confirm-delete="Yes, delete it!">
                                <i class="las la-trash"></i>
                            </a>
                    ';
                                return $action;
                            })
                            ->addColumn('subproduct', function ($row)
                            {
                                return isset($row->subProduct->name)?  $row->subProduct->name : '';
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('admin.models.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
$subProducts= SubProduct::all();
        return view('admin.models.addEdit',compact('subProducts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModelRequest $request)
    {
        $inputs = $request->all();
        Make::create($inputs);
        
        return back()->with('success', 'Make addded successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return view('admin.product.index',compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $makeModel=Make::find($id); 
        $subProducts= SubProduct::all();
        return view('admin.models.addEdit', compact('makeModel','subProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreModelRequest $request, $id)
    {

       
        $makeModel=Make::find($id); 
        $inputs = $request->all();
        $makeModel->update($inputs);
        
        return back()->with('success', 'Make updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Make::find($id)->delete();
        return back()->with('success', 'Make deleted successfully!');
    }

}
