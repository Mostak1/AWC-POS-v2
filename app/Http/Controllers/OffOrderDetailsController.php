<?php

namespace App\Http\Controllers;

use App\Models\OffOrderDetails;
use App\Http\Controllers\Controller;
use App\Models\OffOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OffOrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = OffOrderDetails::with('offorder', 'menu')->get();

        return view('offorderdetails.index', compact('items'));
    }
    public function dailyreport()
    {
        $currentDate = Carbon::now();
        // dd($currentDate);
        $orderCountD = OffOrderDetails::whereDate('created_at', $currentDate)->count();

        $totalSalesD = OffOrder::whereDate('created_at', $currentDate)->sum('total');
        $items = OffOrderDetails::with(['offorder.user', 'menu'])->whereDate('created_at', $currentDate)->get();

        return view('offorderdetails.dailyreport', compact('items', 'orderCountD', 'totalSalesD'));
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
    public function show(OffOrderDetails $offOrderDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OffOrderDetails $offOrderDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OffOrderDetails $offOrderDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffOrderDetails $offOrderDetails)
    {
        if (OffOrderDetails::destroy($offOrderDetails->id)) {
            return back()->with('success', $offOrderDetails->id . ' Deleted!!!!');
        }
    }
}
