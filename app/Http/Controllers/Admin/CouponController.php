<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('admin.coupon.index', compact('coupons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code',
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'use_times' => 'required|numeric|min:1',
            'greater_than' => 'nullable|numeric|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'required_with:starts_at|date|after:starts_at',
            'status' => 'required|boolean',
        ]);

        Coupon::create($request->all());

        if ($request->has('back')) {
            return redirect()->route('admin.coupon.create')->with('success', 'Coupon created successfully. You can create another coupon.');
        }
        return redirect()->route('admin.coupon.index')->with('success', 'Coupon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,' . $id,
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
            'use_times' => 'required|numeric|min:1',
            'greater_than' => 'nullable|numeric|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'required_with:starts_at|date|after:starts_at',
            'status' => 'required|boolean',
        ]);

        $coupon = Coupon::find($id);
        $coupon->update($request->all());

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

        return redirect()->route('admin.coupon.index')->with('success', 'Coupon deleted successfully.');
    }
}
