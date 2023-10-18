<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Products::all();

            $count = Products::count();

            echo $count;
            if ($count > 0) {
                return response()->json($products, 200);

            } else {
                return response()->json(['error' => 'Products not found !!!'], 400);

            }
        } catch (\Exception) {

            return response()->json(['error' => 'An error occurred'], 500);
        }

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
        //echo 'post';
        $product = Products::create($request->post());
        return response()->json([
            'message' => 'Product created successfully',
            'product' => $product,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        //
    }
}
