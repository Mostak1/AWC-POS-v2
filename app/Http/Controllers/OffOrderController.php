<?php

namespace App\Http\Controllers;

use App\Models\OffOrder;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerToken;
use App\Models\Menu;
use App\Models\OffOrderDetails;
use App\Models\OrderLog;
use App\Models\Payment;
use App\Models\Staff;
use App\Models\StaffOrder;
use App\Models\Tab;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OffOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = OffOrder::with('tab', 'user', 'payment')->get();
        return view('offorder.index')->with('items', $items);
    }
    public function dailyreport()
    {
        $currentDate = Carbon::now();
        // dd($currentDate);
        $orderCountD = OffOrder::whereDate('created_at', $currentDate)->count();
        $totalSalesD = OffOrder::whereDate('created_at', $currentDate)->sum('total');
        $totalDisD = OffOrder::whereDate('created_at', $currentDate)->sum('discount');
        $items = OffOrder::with('tab', 'user', 'offorderdetails')->whereDate('created_at', $currentDate)->get();
        // $items = OffOrderDetails::with(['offorder.user', 'menu'])->whereDate('created_at', $currentDate)->get();

        return view('offorder.dailyreport', compact('items', 'orderCountD', 'totalSalesD', 'totalDisD'));
    }
    public function weeklyReport()
    {
        $currentDate = Carbon::now();
        // Get date 7 days ago
        $sevenDaysAgo = Carbon::now()->subDays(7);

        // Get date 30 days ago
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $currentDate = Carbon::now();
        // dd($currentDate);
        $orderCountD = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])->count();
        $totalSalesD = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])->sum('total');
        $totalDisD = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])->sum('discount');
        $items = OffOrder::with('tab', 'user', 'offorderdetails')->whereBetween('created_at', [$sevenDaysAgo, $currentDate])->get();
        // $items = OffOrderDetails::with(['offorder.user', 'menu'])->whereDate('created_at', $currentDate)->get();

        return view('report.weeklyreport', compact('items', 'orderCountD', 'totalSalesD', 'totalDisD'));
    }
    public function monthlyReport()
    {

        // Get the start of the last month
        $lastMonthStart = Carbon::now()->subMonth()->startOfMonth();

        // Get the end of the last month
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();
        $orderCountD = OffOrder::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->count();
        $totalSalesD = OffOrder::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('total');
        $totalDisD = OffOrder::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('discount');

        // Retrieve records for the last month
        $items = OffOrder::with('tab', 'user', 'offorderdetails')
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->get();

        // Fetch orders data
        $data = OffOrderDetails::with('menu.category', 'off_order.payment')->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->get();

        // Filter and aggregate data
        $staffData = [];
        $staffDataJson = json_encode($staffData);
        // Single Data 
        $staffDis = OffOrder::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->sum('discount');
        $staffSale = OffOrder::whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->where('active', 2)->sum('total');

        foreach ($data as $order) {
            $orderDate = substr($order->created_at, 0, 10); // Extract date from created_at

            // Check if the order date matches the selected date and the order is not active
            // if ($order->off_order->active == 2) {
            $menuId = $order->menu_id;
            $cDiscount = $order->menu->price - round((($order->menu->category->discount * $order->menu->price) / 100) / 5) * 5;
            $sDiscount = $cDiscount - round((($order->menu->discount * $cDiscount) / 100) / 5) * 5;

            // If menu id is not in staffData, add it; otherwise, update quantity and total
            if (!isset($staffData[$menuId])) {
                $staffData[$menuId] = [
                    'menuName' => $order->menu->name,
                    'category' => $order->menu->category->name,
                    'date' => $order->created_at,
                    'quantity' => $order->quantity,
                    'price' => $order->menu->price,
                    'total' => $order->total,
                ];
            } else {
                $staffData[$menuId]['quantity'] += $order->quantity;
                $staffData[$menuId]['total'] += $order->total;
            }
            // }
        }
        return view('report.monthlyreport', compact('staffDataJson', 'staffData', 'items', 'orderCountD', 'totalSalesD', 'totalDisD'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $order = new OffOrder();
            $order->tab_id = '1';
            $order->user_id = Auth::user()->id;
            $order->total = $request->totalbill;
            $order->discount = $request->discount;
            $order->reason = $request->reason;
            $order->active = $request->active;
            // if ($request->reason == 'Customer') {
            //     $order->active = 1;
            // } else {
            //     $order->active = 2;
            // }

            $order->save();
            // if ($request->number !== null) {
            //     # code...
            //     $token = new CustomerToken();
            //     $token->mobile = $request->number;
            //     $token->order_id = $order->id;
            //     $token->save();
            // }

            $payment = new Payment();
            $payment->order_id = $order->id;
            $payment->cash = $request->paymentMethod === 'cash' ? 1 : 0;
            $payment->e_cash = in_array($request->paymentMethod, ['bkash', 'card']) ? 1 : 0;
            $payment->method = $request->paymentMethod;
            $payment->total = $request->totalbill - $request->discount;

            // Set transaction number only for 'bkash' payments
            if ($request->paymentMethod === 'bkash' || $request->paymentMethod === 'card') {
                $payment->tranjection_number = $request->transactionId;
            }

            $payment->save();
            foreach ($request->items as $item) {
                $orderDetail = new OffOrderDetails();
                $orderDetail->off_order_id = $order->id;
                $orderDetail->menu_id = $item['id'];
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->total = $item['total'];
                $orderDetail->save();

                $menu = Menu::find($item['id']);
                if ($menu) {
                    $menu->quantity = $menu->quantity - $item['quantity'];
                    $menu->hot = $menu->hot + $item['quantity'];
                    $menu->save();
                }
            }
            if ($request->cid) {
                $customer = Customer::find($request->cid);
                if ($customer) {
                    $customer->total_meal = $customer->total_meal + 1;
                    $customer->consumed_meal = $customer->consumed_meal + $request->totalbill;
                    $customer->save();
                }
            }
            DB::commit();

            return back()->with('success', 'Order Details Added');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error',  'Order Can not submit properly, Please try again.');
        }
    }
    // return view('offorder.order')->with('success','Order Details Added');

    /**
     * Display the specified resource.
     */
    public function show(OffOrder $offorder)
    {
        // $items = OffOrderDetails::with('offorder', 'menu')->where('off_order_id', $offorder->id)->get();
        $items = OffOrderDetails::with('off_order', 'menu')
            ->where('off_order_id', $offorder->id)
            ->get();

        return view('offorder.show', compact('items', 'offorder'))->with('user', Auth::user());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OffOrder $offorder)
    {
        $tabs = Tab::pluck('name', 'id');
        $payMethod = Payment::where('order_id', $offorder->id)->first();
        return view('offorder.edit', compact('offorder'))->with('tabs', $tabs)->with('user', Auth::user());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OffOrder $offorder)
    {
        $uid = Auth::user()->id;

        $data = [
            'tab_id' => $request->tab_id,
            'total' => $request->total,
            'discount' => $request->discount,
            'reason' => $request->reason,
            'active' => $request->active
        ];
        $old = OffOrder::find($offorder->id);


        // Perform the update
        $updateSuccess = $offorder->update($data);

        if ($updateSuccess) {


            if ($request->total !== $old->total) {
                $logData = [
                    'off_order_id' => $offorder->id,
                    'user_id' => $uid,
                    'old' => 'Total Old: ' . $old->total,
                    'new' => 'Total New: ' . $request->total,
                    'methode' => 'Update Total'
                ];
                $log = OrderLog::create($logData);
                if ($log) {
                } else {
                    return back()->with('info', $log . "Not Insert!");
                }
            }

            if ($request->discount !== $old->discount) {
                $logData = [
                    'off_order_id' => $offorder->id,
                    'user_id' => $uid,
                    'old' => 'Discount Old: ' . $old->discount,
                    'new' => 'Discount New: ' . $request->discount,
                    'methode' => 'Update Discount'
                ];
                $log = OrderLog::create($logData);
                if ($log) {
                } else {
                    return back()->with('info', $log . "Not Insert!");
                }
            }

            if ($request->reason !== $old->reason) {
                $logData = [
                    'off_order_id' => $offorder->id,
                    'user_id' => $uid,
                    'old' => 'Reason Old: ' . $old->reason,
                    'new' => 'Reason New: ' . $request->reason,
                    'methode' => 'Update Reason'
                ];
                $log = OrderLog::create($logData);
                if ($log) {
                } else {
                    return back()->with('info', $log . "Not Insert!");
                }
            }

            // Insert log entries

            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!!!");
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OffOrder $offOrder)
    {

        // OffOrderDetails::where('off_order_id', $offOrder->id)->delete();
        $payment = Payment::where('order_id', $offOrder->id)->first();

        if ($payment) {
            dd($payment->id);
        } else {
            dd('No payment found for the given order.');
        }


        OffOrderDetails::where('off_order_id', $offOrder->id)->delete();
        if ($offOrder->delete()) {
            $logData = [
                'off_order_id' => $offOrder->id,
                'user_id' => Auth::user()->id,
                'methode' => 'Delete'
            ];
            $log = OrderLog::create($logData);
            if ($log) {
            } else {
                return back()->with('info', $log . "Not Insert!");
            }
            return back()->with('success', $offOrder->id . ' Deleted');
        } else {

            return back()->with('error', $offOrder->id . 'Not Deleted!!!!');
        }
    }


    // log methode 
    public function logs()
    {
        $items = OrderLog::with('user')->get();
        return view('offorder.log', compact('items'));
    }

    public function orderReport(Request $request)
    {

        // Retrieve filter parameters from the request
        $filterDate = $request->input('filterDate');
        $filterCategory = $request->input('filterCategory');
        $filterStaff = $request->input('filterStaff');
        $filterStartDate = $request->input('filterStartDate');
        $filterEndDate = $request->input('filterEndDate');
        $filterStartTime = $request->input('filterStartTime');
        $filterEndTime = $request->input('filterEndTime');

        // Start building the query with eager loading
        $query = OffOrderDetails::with('menu.category', 'off_order.payment');

        // Apply filters conditionally based on provided parameters
        if ($filterStartDate && $filterEndDate) {
            $query->whereBetween('created_at', [$filterStartDate, $filterEndDate]);
        }

        if ($filterDate) {
            // Assuming $filterDate represents the start date of a date range
            $query->whereDate('created_at', $filterDate);
        }

        if ($filterStartTime && $filterEndTime) {
            $query->whereTime('created_at', '>=', $filterStartTime)
                ->whereTime('created_at', '<=', $filterEndTime);
        }

        // Add more conditions based on other filter parameters if needed
        // Example: Category and Staff filtering
        if ($filterCategory) {
            $query->whereHas('menu.category', function ($q) use ($filterCategory) {
                $q->where('name', $filterCategory);
            });
        }

        if ($filterStaff) {
            //$query->where('active', $filterStaff); // Assuming there's a column named staff_or_customer
            $query->whereHas('off_order', function ($q) use ($filterStaff) {
                $q->where('active', $filterStaff); });
        }

        // Retrieve filtered data
        $data = $query->get();

        // Filter and aggregate data
        $staffData = [];
        $staffDataJson = json_encode($staffData);
        foreach ($data as $order) {
            $menuId = $order->menu_id;
            $cDiscount = $order->menu->price - round((($order->menu->category->discount * $order->menu->price) / 100) / 5) * 5;
            $sDiscount = $cDiscount - round((($order->menu->discount * $cDiscount) / 100) / 5) * 5;

            // If menu id is not in staffData, add it; otherwise, update quantity and total
            if (!isset($staffData[$menuId])) {
                $staffData[$menuId] = [
                    'menuName' => $order->menu->name,
                    'category' => $order->menu->category->name,
                    'date' => $order->created_at,
                    'quantity' => $order->quantity,
                    'price' => $order->menu->price,
                    'total' => $order->total,
                ];
            } else {
                $staffData[$menuId]['quantity'] += $order->quantity;
                $staffData[$menuId]['total'] += $order->total;
            }
        }
        return response()->json($staffData);
        return view('report.monthlyreport', compact('staffDataJson', 'staffData', 'items', 'orderCountD', 'totalSalesD', 'totalDisD'));
    }
}
