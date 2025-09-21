<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index()
    {
        return redirect()->route('products.index');
    }

    public function create()
    {
        return view('register');
    }

    public function store(RegisterRequest $request)
    {
        $image = $request->file('image');
    

    $originalName = $image->getClientOriginalName();
    
    $imagePath = $image->storeAs('img', $originalName, 'public');

    $product = Product::create([
        'name' => $request->name,
        'price' => $request->price,
        'description' => $request->description,
        'image' => $imagePath,
    ]);

    $seasonIds = Season::whereIn('name', $request->season)->pluck('id')->toArray();
    $product->seasons()->sync($seasonIds);

    return redirect()->route('products.index');
    }
}
