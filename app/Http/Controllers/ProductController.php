<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Page;
//use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Image;

class ProductController extends Controller
{

    protected $path;
    function __construct()
    {
        $this->path = public_path('images/product/thumbnail/');
        $this->user = Auth::user();
    }
    public function index()
    {
        if($this->user->hasRole('Admin')){
            return ProductResource::collection(Product::get());
        }else{
            $page= Page::findOrFail($this->user->page->id);
            return ProductResource::collection($page->products);
        }
    }


    public function store(CreateProductRequest $request)
    {
        $page= Page::findOrFail($this->user->page->id);
        $product =new Product;

        $product->name =$request->name;
        $product->description =  $request->description;
        $product->active =$request->active;
        $product->initial_price =$request->initial_price;
        $product->price =$request->price;

        $image = $request->file('image');

        $filename = time(). '.' .$image->getClientOriginalExtension();
        $path = $this->path.$filename;
        //->resize(468, 249)
        $product->image = $filename;
        $page->products()->save($product);
        Image::make($image->getRealPath())->save($path);

        return new ProductResource($product);
    }


//    public function show(Product $product)
//    {
//        return new ProductResource($product);
//    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            $oldfilename = $product->image;
            if (\File::exists($this->path.$oldfilename)) {
                unlink($this->path.$oldfilename);
            }
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(361, 237)->save($this->path.$filename);
            $image->image = $filename;
            $product->image = $filename;
        }

        $product->name =$request->name;
        $product->description =$request->description;
        $product->active =$request->active;
        $product->initial_price =$request->initial_price;
        $product->price =$request->price;


        $product->save();
        return new ProductResource($product);
    }


    public function destroy(Product $product)
    {
        if($this->user->page->id == $product->page_id){
            $page= Page::findOrFail($this->user->page->id);

            $page->products()->whereId($product->id)->delete();
            $imagePath = $product->image;
            if (\File::exists($this->path.$imagePath)) {
                unlink($this->path.$imagePath);
            }
            return new ProductResource($product);
        }else{
            return response()->json(array("error"=>"you have not permission to access"),401);
        }

    }
}
