<?php

namespace App\Http\Controllers;

use App\Models\GlobalSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GlobalSettingController extends Controller
{

    public function index()
    {
        $global_settings = GlobalSetting::orderBy('id', 'desc')->first();
        return view('admin.global_settings.index', compact('global_settings'));
    }
    public function store(Request $request)
    {

        $inputs = $request->all();
        $publicPdfDirectory = public_path('setting');

        if (!File::exists($publicPdfDirectory)) {
            File::makeDirectory($publicPdfDirectory, 0755, true);
        }
        if ($request->logo) {
            $attachment_filename = preg_replace('/\s+/', '', $request->logo->getClientOriginalName());
            $request->logo->move(public_path('/setting'), $attachment_filename);
            $inputs['logo'] = $attachment_filename;
        }
        if ($request->fav_icon) {
            $attachment_filename = preg_replace('/\s+/', '', $request->fav_icon->getClientOriginalName());
            $request->fav_icon->move(public_path('/setting'), $attachment_filename);
            $inputs['fav_icon'] = $attachment_filename;
        }
        if ($request->main_img) {
            $attachment_filename = preg_replace('/\s+/', '', $request->main_img->getClientOriginalName());
            $request->main_img->move(public_path('/setting'), $attachment_filename);
            $inputs['main_img'] = $attachment_filename;
        }
    
        $global_settings = GlobalSetting::orderBy('id', 'desc')->first();
        if ($global_settings) {
            $global_settings->update($inputs);
        } else {
            GlobalSetting::create($inputs);
        }
        return redirect()->route('global_settings.index')->with('success', 'Global Setting created successfully');
    }

    public function update(Request $request, GlobalSetting $global_settings)
    {
        $global_settings->update($request->all());
        return redirect()->route('global_settings.index')->with('success', 'Global Setting updated successfully');
    }
}
