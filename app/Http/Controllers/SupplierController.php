<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items =Supplier::get();
        return view('supplier.index', compact('items'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'web' => $request->web,
    
        ];
        // dd($data);
        $cat = Supplier::create($data);
        if ($cat) {
            return back()->with('success', 'Supplier ' . $cat->id . ' has been created Successfully!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'web' => $request->web,
    
        ];
        // dd($data);
        $cat = $supplier->update($data);
        if ($cat) {
            return back()->with('success', 'Supplier ' . ' has been Update Successfully!');
        }
    }

    public function destroy(Supplier $supplier)
    {
        if (Supplier::destroy($supplier->id)) {
            return back()->with('success', $supplier->id . ' Deleted!!!!');
        }
    }
}
