<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        return view('frontend.order', compact('product'));
    }
}
