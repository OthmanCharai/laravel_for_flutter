<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product=Product::has("images")->has("user")->with(["images","colors","user"])->get();
        //$product=Product::with(["colors","images"])->get();

        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
            "description"=>"required",
            "quantity"=>"required",
            "status"=>"required",
            "price"=>"required",
            "category_id"=>"required",
            "user_id"=>"required"
        ]);
        $category=Category::find($request->category_id);
        $data=[
            'name'=>$request->name,
            'description'=>$request->description,
            'quantity'=>$request->quantity,
            'status'=>$request->status,
            'price'=>$request->price,
            'isPopulaire'=>0,
            'user_id'=>$request->user_id,
        ];
        $product=Product::create($data);
        $user=User::find($request->user_id)->first();
        //$product->user()->syncWithoutDetaching($user);
        $product->categories()->syncWithoutDetaching($category);

        $clrs=Color::all();
        foreach($clrs as $clr){
            $product->colors()->syncWithoutDetaching($clr);
        }

        if($request->hasFile("images")){
            $photo=$request->file("images");
            $photo=Storage::disk("public")->putFile("uploads",$photo);
            $image=new Image();
            $image->image=Storage::url($photo);
            $product->images()->save($image);
            return response()->json("ok");

        }else{
            throw ValidationException::withMessages([
                'files' => ['The provided credentials are incorrect.'],
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user=User::find($id);
        $product=Product::where("user_id",$user->id)->has("images")->with(["images"])->get();
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product=Product::find($id);
        $product->delete();
        return response()->json("ok");

    }
    public function getProductColor($id){
        $product=Product::find($id);
        return response()->json($product->colors);
    }

    public function removeFromProduct(Request $request){
        $product=Product::find($request->product_id);
        $product->categories()->detach([$request->product_id]);
        $product->delete();
        return response()->json("ok");
    }

}

