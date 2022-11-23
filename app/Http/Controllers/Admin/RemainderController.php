<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Remainder;
class RemainderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $remainder= Remainder::where(['user_id'=>auth()->user()->id,'type'=>5])->first();
        $remainderfifteen= Remainder::where(['user_id'=>auth()->user()->id,'type'=>15])->first();
        $remainderthirty= Remainder::where(['user_id'=>auth()->user()->id,'type'=>30])->first();
        $remainderone= Remainder::where(['user_id'=>auth()->user()->id,'type'=>1])->first();

        return view('admin.remainder.index',compact('remainderone','remainder','remainderfifteen','remainderthirty'));
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
       
        if($request->days == 5){
            Remainder::updateOrCreate(
                ['user_id' => auth()->user()->id, 'type' => 5],
                ['message' => $request->message]
            );
        }
        if($request->days == 1){
            Remainder::updateOrCreate(
                ['user_id' => auth()->user()->id, 'type' => 1],
                ['message' => $request->message]
            );
        }
        if($request->days == 15){
            Remainder::updateOrCreate(
                ['user_id' => auth()->user()->id, 'type' => 15],
                ['message' => $request->message]
            );
        }
        if($request->days == 30){
            Remainder::updateOrCreate(
                ['user_id' => auth()->user()->id, 'type' => 30],
                ['message' => $request->message]
            );
        }
        return back()->with('success', 'Reminder addded successfully!');

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
