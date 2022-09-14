<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LightSpeed;
class HomeController extends Controller
{
  public function index()
    {
		$metaInfo= [
					'title'=>'PetParent home page',
					'description'=>'Meta descrption'
				];

		return view('frontend.home', compact('metaInfo'));

    }
		public function lightspeedapptoken(Request $request)
    {
			$inputs=json_encode($request->all());

			LightSpeed::create(['description' => $inputs]);
			echo "Saved Successfully";

    }
}
