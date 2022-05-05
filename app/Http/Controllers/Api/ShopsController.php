<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShopResource;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index(Request $request){
        $shops = Shop::with('user','user.services','user.workTimes','category')
        ->whereHas('user',function($q){
            $q->where('deleted_at' , null);
        })
        ->when($request->category_id , function($q,$value){
            $q->where('category_id',$value);
        })
        ->latest()->paginate(10);
       // return $shops;
        return response()->json([
            'status' => true,
            'data' => ShopResource::collection($shops),
         ]);
    }

    public function viewShop($id){
        $shop = Shop::with('user','user.services','user.workTimes','category')->findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => new ShopResource($shop),
         ]);
    }
}
