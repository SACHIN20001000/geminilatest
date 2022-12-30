<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Communication;
use App\Models\User;
use DataTables;
use Mail;
class CommunicationController extends Controller
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
            $data = Communication::with('users')->orderby('id','DESC')->get();

            return Datatables::of($data)
                            ->addIndexColumn()
                            ->make(true);
        }
        return view('admin.communication.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.communication.addEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
          
        $communication= $request->except( '_token');
        $communication['created_by'] = auth()->user()->id;
        Communication::create($communication);
       $query = User::with('roles');
       if(isset($request->type) && $request->type == 'Admin Only'){
                $query->whereHas(
                    'roles', function ($q)
                    {
                        $q->where('name', '=', 'Admin');
                    });
            }
            if(isset($request->type) && $request->type == 'Broker Only'){
                $query->whereHas(
                    'roles', function ($q)
                    {
                        $q->where('name', '=', 'Broker');
                    });
            }
            if(isset($request->type) && $request->type == 'Staff Only'){
                $query->whereHas(
                    'roles', function ($q)
                    {
                        $q->where('name', '=', 'Staff');
                    });
            }
            if(isset($request->type) && $request->type == 'Client Only'){
                $query->whereHas(
                    'roles', function ($q)
                    {
                        $q->where('name', '=', 'Client');
                    });
            }

       $data=$query->orderby('id','DESC')->get('email');
       if($data->count()){
           foreach ($data as $key => $value) {
          
            try {
                Mail::send('admin.email.communication',['content'=>$request->text],function($messages) use ($request,$value) {            
                       $messages->to($value->email);
                       $messages->bcc('geminiservices@outlook.com');
                       $subject =$request->subject ?? 'Gemini consultancy Service';
                       $messages->subject($subject);      
               }); 
                 
              } catch (Exception $e) {
                 
               }
            
        }
       }
    
       return redirect ()->route ('communications.index')->with ('success', 'Mail Send successfully!');

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
        $expences = Expences::find($id);
        return view('admin.communication.addEdit',compact('expences'));
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
        $expences= $request->except( '_token','_method');
        Expences::find($id)->update($expences);
        return redirect ()->back()->with ('success', 'Expences Updated successfully!');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expences::find($id)->delete();
        return redirect ()->back()->with ('success', 'Expences Delete successfully!');
 
    }
}
