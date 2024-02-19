<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'))->with('user', Auth::user());
    }

    /**
     * Show the form for creating a new resource. 
     */
    public function create()
    {
        return view('category.create')->with('user', Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->extension();
            // $qid  = Category::all()->last()->id;
            $filename = $request->name . '.' . $extention;
            $request->image->move(public_path('/assets/img/category/'), $filename);
        }
        $data = [
            'name' => $request->name,
         
            'images' => $filename ?? '',
          
        ];
        // dd($data);
        $cat = Category::create($data);
        if ($cat) {
            return back()->with('success', 'Category ' . $cat->id . ' has been created Successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('category.show', compact('category'))->with('user', Auth::user());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'))->with('user', Auth::user());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if ($request->hasFile('image')) {
            if ($category->image) {
                $exfile=$category->image;
                $filePath = public_path('/assets/img/category/') . $exfile; // Change this to the actual path of the image you want to delete
                
                if (File::exists($filePath)) {
                    File::delete($filePath);
                   
                }
                Storage::delete($category->image);
            }
            $file = $request->file('image');
            $extention = $file->extension();
            $qid  = $category->name;
            $filename = $qid . '.' . $extention;
            $request->image->move(public_path('/assets/img/category/'), $filename);
        }
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $filename ?? $category->image,
            'active' => $request->active,
        ];

        $category->update($data);
        if ($category->save()) {
            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Category::destroy($category->id)) {
            return back()->with('success', $category->id . ' has been deleted!');
        } else {
            return back()->with('error', 'Delete Failed!');
        }
    }
}
