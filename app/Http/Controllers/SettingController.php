<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Setting::get();
        return view('setting.index', compact('items'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        return view('setting.edit', compact('setting'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        if ($request->hasFile('image')) {
            if ($setting->logo) {
                $exfile=$setting->logo;
                $filePath = public_path('/assets') . $exfile;
                 // Change this to the actual path of the image you want to delete
                if (File::exists($filePath)) {
                    File::delete($filePath);
                   
                }
                Storage::delete($setting->logo);
            }
            $file = $request->file('image');
            $extention = $file->extension();
         
            $filename = 'logo'. '.' . $extention;
            $request->image->move(public_path('/assets'), $filename);
        }
        $data = [
            'c_name' => $request->c_name,
            'address' => $request->address,
            'logo' => $filename ?? $setting->logo,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'website' => $request->website,
            'tax' => $request->tax,
            'discount' => $request->discount,
        ];

        $setting->update($data);
        if ($setting->save()) {
            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
