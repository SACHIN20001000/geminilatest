<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Make;
use App\Models\ModelMake;
use App\Models\MakeModel;
use DataTables;
use App\Http\Requests\Admin\Make\StoreMakeRequest;

class MakeController extends Controller
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
            $data = ModelMake::with('makes')->orderby('id','DESC')->get();

            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function ($row)
                            {
                                $action = '<span class="action-buttons">
                                
                        <a  href="' . route("model.edit", $row) . '" class="btn btn-sm btn-info btn-b"><i class="las la-pen"></i>
                        </a>

                        <a href="' . route("model.destroy", $row) . '"
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
                            ->rawColumns(['action'])
                            ->make(true);
        }
        return view('admin.make.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $makes=Make::all();
        return view('admin.make.addEdit',compact('makes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMakeRequest $request)
    {

     
        $inputs = $request->only(
            'name',
            'make_id'
            );
           $make= ModelMake::create($inputs);
    
            if(!empty($request->varriant_id)){
                MakeModel::where('make_id',$make->id)->where('type','varriant')->delete(); 
                foreach ($request->varriant_id as $key => $varriant) {
                    if(!empty($varriant)){
                        MakeModel::create([
                            'make_id'=> $make->id,
                            'name'=> $varriant,
                            'type' => 'varriant'
                        ]);
                    }
                }
            }
            if(!empty($request->fuel_id)){
                MakeModel::where('make_id',$make->id)->where('type','fuel')->delete(); 
                foreach ($request->fuel_id as $key => $fuel) {
                    if(!empty($fuel)){
                        MakeModel::create([
                            'make_id'=> $make->id,
                            'name'=> $fuel,
                            'type' => 'fuel'
                        ]);
                    }
                }
            }
            if(!empty($request->cc_id)){
                MakeModel::where('make_id',$make->id)->where('type','cc')->delete(); 
                foreach ($request->cc_id as $key => $cc) {
                    if(!empty($cc)){
                        MakeModel::create([
                            'make_id'=> $make->id,
                            'name'=> $cc,
                            'type' => 'cc'
                        ]);
                    }
                }
            }
            if(!empty($request->seating_id)){
                MakeModel::where('make_id',$make->id)->where('type','seating')->delete(); 
                foreach ($request->seating_id as $key => $seating) {
                    if(!empty($seating)){
                        MakeModel::create([
                            'make_id'=> $make->id,
                            'name'=> $seating,
                            'type' => 'seating'
                        ]);
                    }
                }
            }
            if(!empty($request->showroom_id)){
                MakeModel::where('make_id',$make->id)->where('type','showroom')->delete(); 
                foreach ($request->showroom_id as $key => $showroom) {
                    if(!empty($showroom)){
                        MakeModel::create([
                            'make_id'=> $make->id,
                            'name'=> $showroom,
                            'type' => 'showroom'
                        ]);
                    }
                }
            }
            if(!empty($request->od_id)){
                MakeModel::where('make_id',$make->id)->where('type','od')->delete(); 
                foreach ($request->od_id as $key => $od) {
                    if(!empty($od)){
                        MakeModel::create([
                            'make_id'=> $make->id,
                            'name'=> $od,
                            'type' => 'od'
                        ]);
                    }
                }
            }
            if(!empty($request->tp_id)){
                MakeModel::where('make_id',$make->id)->where('type','tp')->delete(); 
                foreach ($request->tp_id as $key => $tp) {
                    if(!empty($tp)){
                        MakeModel::create([
                            'make_id'=> $make->id,
                            'name'=> $tp,
                            'type' => 'tp'
                        ]);
                    }
                }
            }
          
        
        return back()->with('success', 'Model added successfully!');
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
        $makes=Make::all();
        $make=ModelMake::with('makeModels')->where('id',$id)->first();
        return view('admin.make.addEdit', compact('make','makes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMakeRequest $request, $id)
    {
        $inputs = $request->only(
            'name',
            'make_id'
            );
        $make= ModelMake::find($id);
        if($make){
            $make->update($inputs);
        }
           
        if(!empty($request->varriant_id)){
            MakeModel::where('make_id',$make->id)->where('type','varriant')->delete(); 
            foreach ($request->varriant_id as $key => $varriant) {
                if(!empty($varriant)){
                    MakeModel::create([
                        'make_id'=> $make->id,
                        'name'=> $varriant,
                        'type' => 'varriant'
                    ]);
                }
            }
        }
        if(!empty($request->fuel_id)){
            MakeModel::where('make_id',$make->id)->where('type','fuel')->delete(); 
            foreach ($request->fuel_id as $key => $fuel) {
                if(!empty($fuel)){
                    MakeModel::create([
                        'make_id'=> $make->id,
                        'name'=> $fuel,
                        'type' => 'fuel'
                    ]);
                }
            }
        }
        if(!empty($request->cc_id)){
            MakeModel::where('make_id',$make->id)->where('type','cc')->delete(); 
            foreach ($request->cc_id as $key => $cc) {
                if(!empty($cc)){
                    MakeModel::create([
                        'make_id'=> $make->id,
                        'name'=> $cc,
                        'type' => 'cc'
                    ]);
                }
            }
        }
        if(!empty($request->seating_id)){
            MakeModel::where('make_id',$make->id)->where('type','seating')->delete(); 
            foreach ($request->seating_id as $key => $seating) {
                if(!empty($seating)){
                    MakeModel::create([
                        'make_id'=> $make->id,
                        'name'=> $seating,
                        'type' => 'seating'
                    ]);
                }
            }
        }
        if(!empty($request->showroom_id)){
            MakeModel::where('make_id',$make->id)->where('type','showroom')->delete(); 
            foreach ($request->showroom_id as $key => $showroom) {
                if(!empty($showroom)){
                    MakeModel::create([
                        'make_id'=> $make->id,
                        'name'=> $showroom,
                        'type' => 'showroom'
                    ]);
                }
            }
        }
        if(!empty($request->od_id)){
            MakeModel::where('make_id',$make->id)->where('type','od')->delete(); 
            foreach ($request->od_id as $key => $od) {
                if(!empty($od)){
                    MakeModel::create([
                        'make_id'=> $make->id,
                        'name'=> $od,
                        'type' => 'od'
                    ]);
                }
            }
        }
        if(!empty($request->tp_id)){
            MakeModel::where('make_id',$make->id)->where('type','tp')->delete(); 
            foreach ($request->tp_id as $key => $tp) {
                if(!empty($tp)){
                    MakeModel::create([
                        'make_id'=> $make->id,
                        'name'=> $tp,
                        'type' => 'tp'
                    ]);
                }
            }
        }
      
        return back()->with('success', 'Model updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     MakeModel::where('make_id',$id)->delete();
     ModelMake::find($id)->delete();
        return back()->with('success', 'Make deleted successfully!');
    }

}
