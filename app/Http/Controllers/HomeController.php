<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OffOrder;
use App\Models\OffOrderDetails;
use App\Models\Payment;
use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function printrecipt($id)
    {

        $items = OffOrder::with('tab', 'user', 'offorderdetails.menu.category')->find($id);
        return response()->json($items);
    }
    public function main()
    {
        $user_id = Auth::user()->id;
        $roles = UserRole::where('user_id', $user_id)->get();
        return view('layouts.side_nav', compact('roles'));
    }
    public function adminHome()
    {
        $currentDate = Carbon::now();
        // Get date 7 days ago
        $sevenDaysAgo = Carbon::now()->subDays(7);

        // Get date 30 days ago
        $thirtyDaysAgo = Carbon::now()->subDays(30);


        $orderCountD = OffOrder::whereDate('created_at', $currentDate)->count();

        $totalSalesD = OffOrder::whereDate('created_at', $currentDate)

            ->sum('total');
        $totalDisD = OffOrder::whereDate('created_at', $currentDate)

            ->sum('discount');



        // Count orders for the last 7 days
        $orderCountW = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])->count();

        // Count orders for the last 30 days
        $orderCountM = OffOrder::whereBetween('created_at', [$thirtyDaysAgo, $currentDate])->count();

        // Calculate total sales for the last 7 days
        $totalSalesW = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])

            ->sum('total');
        $totalDisW = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])

            ->sum('discount');

        // Calculate total sales for the last 30 days
        $totalSalesM = OffOrder::whereBetween('created_at', [$thirtyDaysAgo, $currentDate])

            ->sum('total');
        $totalDisM = OffOrder::whereBetween('created_at', [$thirtyDaysAgo, $currentDate])

            ->sum('discount');

        $salesCountD = OffOrder::whereDate('created_at', $currentDate)

            ->count();
        $salesCountW = OffOrder::whereBetween('created_at', [$sevenDaysAgo, $currentDate])

            ->count();
        $salesCountM = OffOrder::whereBetween('created_at', [$thirtyDaysAgo, $currentDate])

            ->count();

        // dd($orderCountD);
        $currentDate = Carbon::now();
        // dd($currentDate);
        $orderCountD = OffOrder::whereDate('created_at', $currentDate)->count();
        $orderCountDstaff = OffOrder::whereDate('created_at', $currentDate)->where('active', 2)->count();

        $totalSalesD = OffOrder::whereDate('created_at', $currentDate)->sum('total');
        $totalDisD = OffOrder::whereDate('created_at', $currentDate)->sum('discount');

        $bkash = Payment::whereDate('created_at', $currentDate)->where('method', 'bkash')->sum('total');
        $cash = Payment::whereDate('created_at', $currentDate)->where('method', 'cash')->sum('total');
        $card = Payment::whereDate('created_at', $currentDate)->where('method', 'card')->sum('total');
        $items = OffOrder::with('tab', 'user', 'offorderdetails', 'payment')->whereBetween('created_at', [$sevenDaysAgo, $currentDate])->orderByDesc('id')->get();
        // $items = OffOrder::with('tab', 'user', 'offorderdetails', 'payment')->whereDate('created_at', $currentDate)->get();
        $orderDetails = OffOrderDetails::with('menu', 'off_order')->whereDate('created_at', $currentDate)->get();

        $categories = Category::get();
        // $items = OffOrderDetails::with(['offorder.user', 'menu'])->whereDate('created_at', $currentDate)->get();

        // return view('offorder.dailyreport', compact('items',card 'orderCountD', 'totalSalesD', 'totalDisD'));

        // dd($role);

        return view('dashboard', compact('orderCountDstaff', 'totalDisM', 'totalDisD', 'totalDisW', 'items', 'orderDetails', 'bkash', 'card', 'cash', 'categories'))
            ->with('orderCountD', $orderCountD)
            ->with('totalSalesD', $totalSalesD)
            ->with('salesCountD', $salesCountD)
            ->with('orderCountW', $orderCountW)
            ->with('totalSalesW', $totalSalesW)
            ->with('salesCountW', $salesCountW)
            ->with('orderCountM', $orderCountM)
            ->with('totalSalesM', $totalSalesM)
            ->with('salesCountM', $salesCountM);
    }

    public function offorderDetailsapi()
    {
        $orderDetails = OffOrderDetails::with('menu.category', 'off_order.payment')->get();
        return response()->json($orderDetails);
    }
    public function stafforder()
    {
        $currentDate = Carbon::now();
        $orderDetails = OffOrderDetails::whereDate('created_at', $currentDate)->with('menu.category', 'off_order.payment')->get();
        return response()->json($orderDetails);
    }
    public function customerorder()
    {
        $orderDetails = OffOrderDetails::with('menu.category', 'off_order.payment')->get();
        return response()->json($orderDetails);
    }
    public function reportPage(Request $request)
    {
        $currentDate = Carbon::now()->toDateString();
        // Get current date "2024-02-13"
        $selectedDate = $request->date ??  $currentDate;

        // Single Data 
        $customerSale = OffOrder::whereDate('created_at', $selectedDate)->where('active', 1)->sum('total');
        $staffSale = OffOrder::whereDate('created_at', $selectedDate)->where('active', 2)->sum('total');


        $orderCountD = OffOrder::whereDate('created_at', $selectedDate)->count();

        $totalSalesD = OffOrder::whereDate('created_at', $selectedDate)

            ->sum('total');
        $totalDisD = OffOrder::whereDate('created_at', $selectedDate)

            ->sum('discount');


        $bkash = Payment::whereDate('created_at', $selectedDate)->where('method', 'bkash')->sum('total');
        $cash = Payment::whereDate('created_at', $selectedDate)->where('method', 'cash')->sum('total');
        $card = Payment::whereDate('created_at', $selectedDate)->where('method', 'card')->sum('total');





        // Fetch orders data
        $data = OffOrderDetails::with('menu.category', 'off_order.payment')->get();

        // Filter and aggregate data
        $staffData = [];
        foreach ($data as $order) {
            $orderDate = substr($order->created_at, 0, 10); // Extract date from created_at

            // Check if the order date matches the selected date and the order is not active
            if ($orderDate !== $selectedDate || $order->off_order->active == 1) {
                continue;
            }

            $menuId = $order->menu_id;

            // Calculate discounts
            $cDiscount = $order->menu->price - round((($order->menu->category->discount * $order->menu->price) / 100) / 5) * 5;
            $sDiscount = $cDiscount - round((($order->menu->discount * $cDiscount) / 100) / 5) * 5;

            // If menu id is not in staffData, add it; otherwise, update quantity and total
            if (!isset($staffData[$menuId])) {
                $staffData[$menuId] = [
                    'menuName' => $order->menu->name,
                    'category' => $order->menu->category->name,
                    'date' => $order->created_at,
                    'quantity' => $order->quantity,
                    'price' => $sDiscount,
                    'total' => $order->total,
                ];
            } else {
                $staffData[$menuId]['quantity'] += $order->quantity;
                $staffData[$menuId]['total'] += $order->total;
            }
        }
        // Filter and aggregate data
        $customerData = [];
        foreach ($data as $order) {
            $orderDate = substr($order->created_at, 0, 10); // Extract date from created_at

            // Check if the order date matches the selected date and the order is not active
            if ($orderDate !== $selectedDate || $order->off_order->active == 2) {
                continue;
            }

            $menuId = $order->menu_id;

            // Calculate discounts
            $cDiscount = $order->menu->price - round((($order->menu->category->discount * $order->menu->price) / 100) / 5) * 5;
            $sDiscount = $cDiscount - round((($order->menu->discount * $cDiscount) / 100) / 5) * 5;

            // If menu id is not in customerData, add it; otherwise, update quantity and total
            if (!isset($customerData[$menuId])) {
                $customerData[$menuId] = [
                    'menuName' => $order->menu->name,
                    'category' => $order->menu->category->name,
                    'date' => $order->created_at,
                    'quantity' => $order->quantity,
                    'price' => $cDiscount,
                    'total' => $order->total,
                ];
            } else {
                $customerData[$menuId]['quantity'] += $order->quantity;
                $customerData[$menuId]['total'] += $order->total;
            }
        }
        return view('report.dailyreport', compact('staffSale', 'customerSale', 'customerData', 'staffData', 'bkash', 'card', 'cash', 'orderCountD', 'totalSalesD', 'selectedDate'));
        // You can return the aggregated data to a view or as an API response
        return response()->json([
            'customerData' => $customerData,
            'staffData' => $staffData,
        ]);
    }
    public function moneyReceipt($id)
    {

        // Fetch orders data
        $data = OffOrderDetails::with('menu.category', 'off_order.payment')->where('off_order_id', $id)->get();
        $order = OffOrder::with('payment')->where('id', $id)->first();
        // dd($order->payment->method);
        $invoice = $id;
        $payMethod = $order->payment->method;
        $total = $order->total;
        // Filter and aggregate data
        $staffData = [];
        foreach ($data as $order) {
            $orderDate = substr($order->created_at, 0, 10); // Extract date from created_at

            // Check if the order date matches the selected date and the order is not active
            if ($order->off_order->active == 1) {


                $menuId = $order->menu_id;

                // Calculate discounts
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
                        //  'sprice' => $sDiscount,
                        'cprice' => $cDiscount,
                        'total' => $order->total,
                    ];
                } else {
                    $staffData[$menuId]['quantity'] += $order->quantity;
                    $staffData[$menuId]['total'] += $order->total;
                }
            } else {


                $menuId = $order->menu_id;

                // Calculate discounts
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
                        'sprice' => $sDiscount,
                        'cprice' => 0,
                        'total' => $order->total,
                    ];
                } else {
                    $staffData[$menuId]['quantity'] += $order->quantity;
                    $staffData[$menuId]['total'] += $order->total;
                }
            }
        }
        return view('receipt', compact('staffData', 'invoice', 'payMethod', 'total'));
    }
}
