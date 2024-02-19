<?php

namespace App\Http\Controllers;

use App\Models\Tab;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TabController extends Controller
{
    //Tab $tab
    public function index()
    {
        $alls = Tab::get();
        return view("tab.index")
            ->with('alls', $alls);
    }

    public function create()
    {
        
        return view("tab.create")->with('user', Auth::user());
    }

    public function store(Request $request)
    {
       
        $data = [
            'name' => $request->name,
         
            'capacity' => $request->capacity,
          
        ];
        // dd($data);
        $create = Tab::create($data);
        if ($create) {
            return back()->with('success', 'Subject '.' has been created successfully!')->withInput($request->input());
        } else {
            return back()->with('success', 'Error!!');
        }
    }

    public function show(Tab $tab)
    {
        return view('tab.show', compact('tab'))->with('user', Auth::user());
    }

    public function edit(Tab $tab)
    {
        $categories = Tab::pluck('name', 'id');
        return view('tab.edit', compact('tab'))->with('categories', $categories)->with('user', Auth::user());
   
    }

    public function update(Request $request,Tab $tab)
    {
        $tab->update($request->all());
        if ($tab->save()) {
            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!!!");
        }
    }

 
    public function destroy(Tab $tab)
    {
        if (Tab::destroy($tab->id)) {
            return back()->with('success', $tab->id . ' Deleted!!!!');
        }
    }
}

// Tab $tab