<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SQL injection prevention with Laravel's Eloquent ORM (Object-Relational Mapping)
        $products = Product::all();
        return response()->json($products);
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
        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'active_ingredients' => 'required|string',
            'batch_number' => [
                'required',
                'string',
                'unique:products',
                'regex:/^[A-Z]{2}\d{8}$/' // Enforces format like 'AB12345678'
            ],
            'research_status' => 'required|string',
            'manufacturing_date' => 'required|date_format:Y-m-d',
            'expiration_date' => 'required|date_format:Y-m-d|after:manufacturing_date',
        ]);
        
        // Sanitize inputs using strip_tags() to prevent Cross-Site Scripting (XSS attacks).
        $validatedData['name'] = strip_tags($validatedData['name']);
        $validatedData['category'] = strip_tags($validatedData['category']);
        $validatedData['active_ingredients'] = strip_tags($validatedData['active_ingredients']);
        $validatedData['research_status'] = strip_tags($validatedData['research_status']);
        
        // Create the product
        $product = Product::create($validatedData);
        
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string',
            'category' => 'sometimes|required|string',
            'active_ingredients' => 'sometimes|required|string',
            // The $id at the end tells Laravel to ignore the current product's ID when checking for uniqueness
            'batch_number' => [
                'sometimes',
                'required',
                'string',
                'unique:products,batch_number,' . $id,
                'regex:/^[A-Z]{2}\d{8}$/' // Enforces format like 'AB12345678'
            ],
            'research_status' => 'sometimes|required|string',
            'manufacturing_date' => 'sometimes|required|date_format:Y-m-d',
            'expiration_date' => 'sometimes|required|date_format:Y-m-d|after:manufacturing_date',
        ]);

        // Sanitize inputs to prevent Cross-Site Scripting (XSS attacks).
        $validatedData['name'] = strip_tags($validatedData['name']);
        $validatedData['category'] = strip_tags($validatedData['category']);
        $validatedData['active_ingredients'] = strip_tags($validatedData['active_ingredients']);
        $validatedData['research_status'] = strip_tags($validatedData['research_status']);
        
        // Update the product
        $product->update($validatedData);

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(null, 204); // Return 204 No Content
    }
}
