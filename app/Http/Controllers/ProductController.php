<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Page;
//use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

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
        if (! Gate::allows('product-list')) {
            throw new AuthorizationException('You have not permission');
        }

        if($this->user->hasRole('Admin')){
            return ProductResource::collection(Product::all());
        }else{
//            $category = Category::find(1);
//            $category->products; // will return all products for the category id 1
//
//            $product = Product::find(1);
//            $product->categories; // will return all categories for the product id 1
            $page= Page::findOrFail($this->user->page->id);
            return ProductResource::collection($page->products);
        }
    }


    public function store(CreateProductRequest $request)
    {
        if($request->price >= $request->initial_price){
            return response()->json(array("error"=>"Initial price must be higher than price"),401);
        }
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

        $categories = Category::find($request->category_ID);


        $page->products()->save($product);
        $product->categories()->attach($categories);
        Image::make($image->getRealPath())->save($path);

        return new ProductResource($product);
    }


//    public function show(Product $product)
//    {
//        return new ProductResource($product);
//    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        if($request->price >= $request->initial_price){
            return response()->json(array("error"=>"Initial price must be higher than price"),401);
        }
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


        $categories = Category::find($request->category_ID);
        $product->categories()->sync($categories);
        $product->save();
        return new ProductResource($product);
    }


    public function destroy(Product $product)
    {
        if (! Gate::allows('product-delete')) {
            throw new AuthorizationException('You have not permission');
        }
        if($this->user->page->id == $product->page_id){
            $page= Page::findOrFail($this->user->page->id);
            $product->categories()->detach();
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
