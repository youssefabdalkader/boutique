<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\User;
use Illuminate\Http\Request;

class ProductCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productComments = ProductComment::paginate(10);
        return view('admin.product_comments.index', compact('productComments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('admin.product_comments.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'status' => 'boolean',
            'rate' => 'integer|min:0|max:5',
        ]);

        ProductComment::create($request->all());

        return redirect()->route('admin.product_comments.index')
            ->with('success', 'Product comment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productComment = ProductComment::findOrFail($id);
        return view('admin.product_comments.show', compact('productComment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::all();
        $products = Product::all();
        $productComment = ProductComment::findOrFail($id);
        return view('admin.product_comments.edit', compact('productComment', 'users', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productComment = ProductComment::findOrFail($id);

        $request->validate([
            'message' => 'required|string|max:500',
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'status' => 'boolean',
            'rate' => 'integer|min:0|max:5',
        ]);

        $productComment->update($request->all());

        return redirect()->route('admin.product_comments.index')
            ->with('success', 'Product comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productComment = ProductComment::findOrFail($id);
        $productComment->delete();

        return redirect()->route('admin.product_comments.index')
            ->with('success', 'Product comment deleted successfully.');
    }
}
