<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort === 'asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'desc') {
                $query->orderBy('price', 'desc');
            }
        }

        $products = $query->paginate(6)->appends($request->query());

        return view('product', compact('products'));
    }

    public function show(Product $product)
    {
        return view('product_show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product_edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $filename = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('img', $filename, 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index');
    }
}