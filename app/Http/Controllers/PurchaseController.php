<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Purchase::with('user','supplier')->get();
        return view('purchase.index', compact('items'));
    }

    public function create()
    {
        $items =Material::get();
        $lastOrderId = Purchase::orderBy('id', 'DESC')->value('id');
        $supplier = Supplier::pluck('name', 'id');
        return view('purchase.create', compact('items','lastOrderId','supplier'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = new Purchase();
        $order->supplier_id = $request->supplier_id;
        $order->total = $request->totalbill;
        $order->user_id = Auth::user()->id;
        $order->save();

        foreach ($request->items as $item) {
            $orderDetail = new PurchaseDetail();
            $orderDetail->purchase_id = $order->id;
            $orderDetail->material_id = $item['id'];
            $orderDetail->quantity = $item['quantity'];
            $orderDetail->save();

            $menu = Material::find($item['id']);
            if ($menu) {
                $menu->quantity = $menu->quantity - $item['quantity'];
                $menu->save();
            }
        }
        return back()->with('info', 'Purchases History Submited');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        $item_p = Purchase::with('user','supplier')->where('id', $purchase->id)->get();
        $items = PurchaseDetail::with('material')->where('purchase_id', $purchase->id)->get();
        return view('purchase.show',compact('items','item_p'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
