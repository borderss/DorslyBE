<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResourse;
use App\Models\BusinessOwner;
use App\Models\Product;
use App\Models\TitlePhotos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return ProductResourse::collection(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ProductResourse
     */
    public function store(ProductRequest $request)
    {
        if (auth()->user()->is_admin === false){
            return response()->json([
                'message' => 'You are not authorized to do this action'
            ], 403);
        }

        $product = Product::create($request->validated());

        return new ProductResourse($product);
    }

    public function storeForBusinessOwner(Request $request)
    {
        $request->validate([
            'name' =>'required',
            'description' =>'required',
            'ingredients' =>'required',
            'price' =>'required',
            'image' =>'required',
        ]);

        $ownerPOI = BusinessOwner::where('user_id', Auth::user()->id)->first()->point_of_interest_id;
        $request['point_of_interest_id'] = $ownerPOI;
        $product = Product::create($request->all());

        $image = $request->file('image');
        $imageName = $image->hashName();
        $image->store('public/product_photo/');
        $product->image = $imageName;
        $product->save();

        return new ProductResourse($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ProductResourse
     */
    public function show($id)
    {
        return new ProductResourse(Product::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return ProductResourse
     */
    public function update(ProductRequest $request, $id)
    {
        if (auth()->user()->is_admin === false){
            return response()->json([
                'message' => 'You are not authorized to do this action'
            ], 403);
        }

        Product::find($id)->update($request->validated());

        return  new ProductResourse(Product::find($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return ProductResourse
     */
    public function destroy($id)
    {
        if (auth()->user()->is_admin === false){
            return response()->json([
                'message' => 'You are not authorized to do this action'
            ], 403);
        }

        $product = Product::find($id);
        $product->delete();
        return new ProductResourse($product);
    }

    public function filterProducts(Request $request)
    {
        $validated = $request->validate([
            'by'=>'required',
            'value'=>'required',
            'paginate'=>'required|integer'
        ]);

        if ($validated['by'] == 'all'){
            $product = Product::where('id', "LIKE", "%{$validated['value']}%")
                ->orWhere('name', "LIKE", "%{$validated['value']}%")
                ->orWhere('description', "LIKE", "%{$validated['value']}%")
                ->orWhere('point_of_interest_id', "LIKE", "%{$validated['value']}%")
                ->orWhere('ingredients', "LIKE", "%{$validated['value']}%")
                ->orWhere('price', "LIKE", "%{$validated['value']}%")
                ->orWhere('created_at', "LIKE", "%{$validated['value']}%")
                ->orWhere('updated_at', "LIKE", "%{$validated['value']}%")
                ->paginate($validated['paginate']);
        } else {
            $product = Product::where($validated['by'], "LIKE", "%{$validated['value']}%")
                ->paginate($validated['paginate']);
        }

        return ProductResourse::collection($product);
    }

    public function filterBusinessProducts(Request $request)
    {
        $validated = $request->validate([
            'by'=>'required',
            'value'=>'required',
            'paginate'=>'required|integer'
        ]);

        $ownerPOI = BusinessOwner::where('user_id', Auth::user()->id)->first()->point_of_interest_id;

        if ($validated['by'] == 'all'){
            $product = Product::having('point_of_interest_id', '=', $ownerPOI)
                ->where('id', "LIKE", "%{$validated['value']}%")
                ->orWhere('name', "LIKE", "%{$validated['value']}%")
                ->orWhere('description', "LIKE", "%{$validated['value']}%")
                ->orWhere('point_of_interest_id', "LIKE", "%{$validated['value']}%")
                ->orWhere('ingredients', "LIKE", "%{$validated['value']}%")
                ->orWhere('price', "LIKE", "%{$validated['value']}%")
                ->orWhere('created_at', "LIKE", "%{$validated['value']}%")
                ->orWhere('updated_at', "LIKE", "%{$validated['value']}%")
                ->groupBy('id')
                ->paginate($validated['paginate']);
        } else {
            $product = Product::having('point_of_interest_id', '=', $ownerPOI)
                ->where($validated['by'], "LIKE", "%{$validated['value']}%")
                ->groupBy('id')
                ->paginate($validated['paginate']);
        }

        return ProductResourse::collection($product);
    }

    public function getFile(Request $request, $id){
        if(!$request->hasValidSignature()) return abort(401);
        $product = Product::find($id);
        $product->image = Storage::disk('local')->path('public/product_photo/'.$product->image);

        return response()->file($product->image);
    }
}
