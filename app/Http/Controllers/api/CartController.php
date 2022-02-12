<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user=User::find($request->user_id);
        $product=Product::whereHas('carts', function (Builder $query )use ($user){
            $query->where('user_id', 'like', $user->id);
        })->with(["carts","images","colors"])->get();
        //
       /*  $cart=Cart::where('user_id',1)->with('colors')->get();
        $product=Product::has("carts")->wher('id',)->where('user_id',$request->user_id)->get();
        //$product=Product::where('id',$cart->product_id);

        */
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
        //
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
    }
    public function addToCart(Request $request){
        $user=User::find($request->user_id);
        $product=Product::find($request->product_id);
        $user->userCarts()->syncWithoutDetaching($product);
        $cart=Cart::all()->last();
        $cart->quantity=$request->quantity;
        $cart->save();

        foreach($request->color as $col  ){
            $cart->colors()->syncWithoutDetaching([$col]);
        }
        return response()->json($cart);
    }
    public function removeFromCart(Request $request){
        $user=User::find($request->user_id);
        $cart=Cart::find($request->cart_id);
        $user->userCarts()->detach([$request->product_id]);
        $cart->colors()->sync([]);
        return response()->json("ok");
    }
}
