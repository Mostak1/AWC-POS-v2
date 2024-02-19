<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items =Material::get();
        return view('material.index', compact('items'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('material.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'price' => $request->price,
            
    
        ];
        // dd($data);
        $cat = Material::create($data);
        if ($cat) {
            return back()->with('success', 'Material ' . $cat->id . ' has been created Successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('material.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $data = [
            'name' => $request->name,
            'unit' => $request->unit,
            'quantity' => $request->quantity,
            'price' => $request->price,
            
    
        ];
        // dd($data);
        $cat = $material->update($data);
        if ($cat) {
            return back()->with('success', 'Material ' . ' has been created Successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        if (Material::destroy($material->id)) {
            return back()->with('success', $material->id . ' Deleted!!!!');
        }
    }
}
