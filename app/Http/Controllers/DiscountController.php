<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Discount::get();
        return view('discount.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 'name','discount','fixed','column1','column2','column3'
        $data = [
            'name' => $request->name,
            'discount' => $request->discount,
            'fixed' => $request->fixed ?? '',
            'column1' => $request->column1 ?? '',
            'column2' => $request->column2 ?? '',
            'column3' => $request->column3 ?? '',
        ];
        Discount::create($data);
        return redirect()->route('discounts.index')->with('success','Discount Policy Added Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        return view('discount.show', compact('discount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discount $discount)
    {
        return view('discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discount $discount)
    {
        if ($request->name) {
            $discount->name = $request->name;
        }
        if ($request->discount) {
            $discount->discount = $request->discount;
        }
        if ($request->fixed) {
            $discount->fixed = $request->fixed;
        }
        if ($request->column1) {
            $discount->column1 = $request->column1;
        }
        if ($request->column2) {
            $discount->column2 = $request->column2;
        }
        if ($request->column3) {
            $discount->column3 = $request->column3;
        }
        $discount->save();
        return redirect()->route('discounts.index')->with('success','Discount Policy Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discount $discount)
    {
        // dd($discount->id);
        if (Discount::destroy($discount->id)) {
            return back()->with('success', $discount->name . ' Deleted!!!!');
        }
        // $discount->id->delete();
        // return redirect()->route('discounts.index')->with('success','Discount Policy Deleted Successfully');
    }
}
