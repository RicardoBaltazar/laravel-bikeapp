<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;

class ProductController extends Controller
{
    private $product;

    public function __construct(Products $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $product = $this->product->paginate('5');

        return response()->json($product, 200);
    }
}
