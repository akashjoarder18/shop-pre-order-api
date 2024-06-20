<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('guest');

    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Product::pluck('product_name','id');
    }
}
