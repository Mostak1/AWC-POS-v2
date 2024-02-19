<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class SubcategoryController extends Controller
{

    public function index()
    {
        $allsubcat = Subcategory::with('category')->get();
        return view("subcategory.index")
            ->with('allsubcat', $allsubcat);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        // array_unshift($categories , ['-1'=>"Select Category"]);
        // dd($categories);
        return view("subcategory.create")->with('categories', $categories)->with('user', Auth::user());
    }

    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->extension();
            $filename = Str::random(5) . '.' . $extention;
            $request->image->move(public_path('/assets/img/subcat/'), $filename);
        }
        $sc = new Subcategory();
        $sc->name = $request->name;
        $sc->images = $filename ?? 'will';
       
        
        $c = Category::find($request->category_id);
        if ($c->subcategories()->save($sc)) {
            return back()->with('success', 'Subject ' . $sc->id . ' has been created successfully!')->withInput($request->input());
        } else {
            return back()->with('success', 'Error!!');
        }
    }

    public function show(Subcategory $subcategory)
    {
        return view('subcategory.show', compact('subcategory'))->with('user', Auth::user());
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::pluck('name', 'id');
        return view('subcategory.edit', compact('subcategory'))->with('categories', $categories)->with('user', Auth::user());
   
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $subcategory->update($request->all());
        if ($subcategory->save()) {
            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!!!");
        }
    }

 
    public function destroy(Subcategory $subcategory)
    {
        if (Subcategory::destroy($subcategory->id)) {
            return back()->with('success', $subcategory->id . ' Deleted!!!!');
        }
    }

    public function subcats($cid)
 {
     //$cid = $request->cid;
     $cat = Subcategory::where('category_id', $cid)->pluck('name', 'id');
     return response()->json($cat);
 }
}
