<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::paginate());
    }


    public function store(CreateProductRequest $request)
    {
        if ($request->hasFile('image')) {
            $imageName = $request->image->getClientOriginalName();
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category_id;
            $product->page_id = $request->page_id;
            $product->image = $imageName;
            $product->save();
        } else {
            return response()->json("The Product failed to be stored", 404);
        }

        return new ProductResource($product);
    }


    public function show(Product $product)
    {
        return new ProductResource($product);
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->only([
            'name', 'description', 'price', 'category_id', 'page_id',
        ]);

        if ($request->hasFile('image')) {
            $imageName = $request->image->getClientOriginalName();

            $data['image'] = $imageName;
        }

        $product->update($data);

        return new ProductResource($product);
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return new ProductResource($product);
    }
}
