<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Menulog;
use App\Models\OffOrder;
use App\Models\Staff;
use App\Models\Subcategory;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class MenuController extends Controller
{

    public function index()
    {
        $menus = Menu::with(['category', 'subcategory'])->get();
        return view('menu.index', compact('menus'))->with('user', Auth::user());
    }
    public function index2()
    {
        $menus = Menu::with(['category', 'subcategory'])->get();
        return response()->json(['menus' => $menus]);
    }

    public function order()
    {
        $lastOrderId = OffOrder::orderBy('id', 'DESC')->value('id');
        $cats = Category::get();
        $staffs= Staff::get();
        $customers = Customer::with('menu', 'user','discount')->get();

        $menus = Menu::with(['category', 'subcategory'])->paginate(12);
        return view('offorder.order', compact('menus','customers', 'lastOrderId', 'cats','staffs'))->with('user', Auth::user());
    }
    public function menu()
    {
        $menus = Menu::with(['category', 'subcategory'])->get();
        return response()->json($menus);
    }
    public function catmenu($id)
    {
        $catmenu = Menu::with(['category', 'subcategory'])->where('category_id', $id)->get();

        return response()->json($catmenu);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        $subcategories = Subcategory::pluck('name', 'id');
        return view('menu.create')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('user', Auth::user());
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:40', // Max 40kb
            'details' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0|max:100',
            'active' => 'boolean',
            'status' => 'boolean',
            'featured' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->extension();
            $filename = Str::random(5) . '.' . $extention;

            $img = \Image::make($file->getRealPath());

            // Resize the image to approximately 40KB
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $img->encode('jpg', 60); // Convert to JPEG with quality of 60

            $path = $file->storeAs('menu', $filename, 'public');
        }

        $data = [
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'image' => $filename ?? '',
            'details' => $request->details,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'active' => $request->active ?? 1,
            'status' => $request->status ?? 1,
            'featured' => $request->featured ?? 0,
        ];

        $cat = Menu::create($data);

        if ($cat) {
            return back()->with('success', 'Category ' . $cat->id . ' has been created Successfully!');
        }
    }
    // public function store(Request $request)
    // {
    //     if ($request->hasFile('image')) {
    //         $file = $request->file('image');
    //         $extention = $file->extension();
    //         $filename = Str::random(5) . '.' . $extention;
    //         // $request->image->move(public_path('/assets/img/menu/'), $filename);
    //         $path = $request->file('image')->storeAs('menu', $filename, 'public');
    //     }
    //     $data = [
    //         'category_id' => $request->category_id,
    //         'subcategory_id' => $request->subcategory_id,
    //         'name' => $request->name,
    //         'image' => $filename ?? '',
    //         'details' => $request->details,
    //         'price' => $request->price,
    //         'quantity' => $request->quantity,
    //         'discount' => $request->discount,
    //         'active' => $request->active ?? 1,
    //         'status' => $request->status ?? 1,
    //         'featured' => $request->featured ?? 0,
    //     ];
    //     // dd($data);
    //     $cat = Menu::create($data);
    //     if ($cat) {
    //         return back()->with('success', 'Category ' . $cat->id . ' has been created Successfully!');
    //     }
    // }


    public function show(Menu $menu)
    {
        return view('menu.show', compact('menu'))->with('user', Auth::user());
    }


    public function edit(Menu $menu)
    {
        $categories = Category::pluck('name', 'id');
        $subcategories = Subcategory::pluck('name', 'id');
        return view('menu.edit', compact('menu'))
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('user', Auth::user());
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        if ($request->hasFile('image')) {
            if ($menu->image) {
                $exfile = $menu->image;
                if (Storage::disk('public')->exists('menu/' . $exfile)) {
                    Storage::disk('public')->delete('menu/' . $exfile);
                }
            }
            $file = $request->file('image');
            $extention = $file->extension();

            $filename = Str::random(5) . '.' . $extention;
            $path = $request->file('image')->storeAs('menu', $filename, 'public');
        }
        $data = [
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id ?? $menu->subcategory_id,
            'name' => $request->name,
            'image' => $filename ?? $menu->image,
            'details' => $request->details,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'active' => $request->active ?? 1,
            'status' => $request->status ?? 1,
            'featured' => $request->featured ?? 0,
        ];
        $uid = Auth::user()->id;
        $old = Menu::find($menu->id);
        $menu->update($data);
        if ($menu->save()) {
            if ($request->name !== $old->name) {
                $logData = [
                    'menu_id' => $menu->id,
                    'user_id' => $uid,
                    'old' => 'Name Old:' . $old->name,
                    'new' => 'Name New:' . $request->name,
                    'methode' => 'Update Name'
                ];
                $log = Menulog::create($logData);
                if ($log) {
                } else {
                    return back()->with('info', $log . "Not Insert!");
                }
            }

            if ($request->price !== $old->price) {
                $logData = [
                    'menu_id' => $menu->id,
                    'user_id' => $uid,
                    'old' => 'Price Old: ' . $old->price,
                    'new' => 'Price New: ' . $request->price,
                    'methode' => 'Update Price'
                ];
                $log = Menulog::create($logData);
                if ($log) {
                } else {
                    return back()->with('info', $log . "Not Insert!");
                }
            }
            if ($request->quantity !== $old->quantity) {
                $logData = [
                    'menu_id' => $menu->id,
                    'user_id' => $uid,
                    'old' => 'Quantity Old:' . $old->quantity,
                    'new' => 'Quantity New:' . $request->quantity,
                    'methode' => 'Update Quantity'
                ];
                $log = Menulog::create($logData);
                if ($log) {
                } else {
                    return back()->with('info', $log . "Not Insert!");
                }
            }
            if ($request->discount !== $old->discount) {
                $logData = [
                    'menu_id' => $menu->id,
                    'user_id' => $uid,
                    'old' => 'Discount Old: ' . $old->discount,
                    'new' => 'Discount New: ' . $request->discount,
                    'methode' => 'Update Discount'
                ];
                $log = Menulog::create($logData);
                if ($log) {
                } else {
                    return back()->with('info', $log . "Not Insert!");
                }
            }

            return back()->with('success', "Update Successfully!");
        } else {
            return back()->with('error', "Update Failed!");
        }
    }

    public function destroy(Menu $menu)
    {
        if (Menu::destroy($menu->id)) {
            return back()->with('success', $menu->id . ' Deleted!!!!');
        }
    }
    public function logs()
    {
        $items = Menulog::with('user')->get();
        return view('menu.log', compact('items'));
    }
}
