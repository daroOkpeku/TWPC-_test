<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
         
        $this->middleware('permission:view_product')->only(['index', 'show']);
        $this->middleware('permission:create_product')->only(['create', 'store']);
        $this->middleware('permission:edit_product')->only(['edit', 'update']);
        $this->middleware('permission:delete_product')->only(['destroy']);

    
    }



    public function index()
    {
      if(auth()->user()->is_blocked == 1){
             auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/')->with('error', 'Your account has been blocked.');
        }
        $products = auth()->user()->products()->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      if(auth()->user()->is_blocked == 1){
             auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/')->with('error', 'Your account has been blocked.');
        }
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
          if(auth()->user()->is_blocked == 1){
            auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/')->with('error', 'Your account has been blocked.');
        }
        $validated = $request->validated();
        auth()->user()->products()->create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
     if(auth()->user()->is_blocked == 1){
             auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect('/')->with('error', 'Your account has been blocked.');
        }
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }
        $validated = $request->validated();
        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->user_id !== auth()->id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
