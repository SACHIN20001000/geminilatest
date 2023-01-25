<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BacklinkResource;
use Illuminate\Http\Request;
use App\Models\Bachlink;

class BacklinkController extends Controller
{
    public function index()
    {
        return BacklinkResource::collection(Bachlink::all());
    }
    public function store(Request $request)
    {
        Bachlink::create($request->all());
        echo 'Success ';
    }
    public function delete($id)
    {

        Bachlink::find($id)->delete();
        echo "deleted";
    }
}
