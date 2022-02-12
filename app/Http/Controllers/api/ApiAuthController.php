<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


use App\Http\Requests\AuthRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Stringable;

class ApiAuthController extends Controller
{
    public function login(AuthRequest $request){
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
            //return response()->json(['email' => ['The provided credentials are incorrect.']]);
        }
    $data=$user->createToken($request->device_name)->plainTextToken;
     $user["token"]=$data;
     $product=Product::where("user_id",$user->id)->get();
     return response()->json(["status"=>true,"message"=>"تم تسجيل الدخول بنجاح","data"=>$user,"products"=>$product]);
       //return response()->json(['api_token'=> $user->createToken($request->device_name)->plainTextToken]);
    }
    public function deleteToken(Request $request){
        $user=$request->user();
        $user->tokens()->delete();
        return response()->json(['api_token'=>"token was deleted"]);
    }
    public function getUser(Request $request){
        $id=$request->id;
        $prd=$request->user()->userFavorite()->get();
        return response()->json(['user'=>$request->user(),"favorites"=>$prd]);
    }

    public function store(Request $request){
        $rememberme=null;
        if($request['remember_token']){
            $rememberme=Str::random(10);
        }

        $user=User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'remember_token'=>$rememberme,
            "phone"=>$request['phone'],
            "image"=>$request["image"],
        ]);
        event(new Registered($user));
        $token = $user->createToken('authtoken');

        return response()->json(
            [
                'message'=>'User Registered',
                'data'=> ['token' => $token->plainTextToken, 'user' => $user]
            ]
        );

    }
    public function addToFavorite(Request $request){
        $user=User::find($request->user_id);
        $user->userFavorite()->syncWithoutDetaching([$request->product_id]);
        return response()->json("ok");
    }
    public function getFavorite($user_id){
        $user=User::find($user_id);
        $product=Product::whereHas('favorites', function (Builder $query )use ($user){
            $query->where('user_id', 'like', $user->id);
        })->has("images")->with("images")->get();
        return response()->json($product);

    }
    public function removeFromFavorite(Request $request){
        $user=User::find($request->user_id);
        $user->userFavorite()->detach([$request->product_id]);
        return response()->json("ok");
    }


}
