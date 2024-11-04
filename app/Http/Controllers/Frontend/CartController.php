<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function CartView(){

        $user_id = Auth::user()->id;
        $products = Product::select('products.*','carts.qty')
                    ->join('carts', 'carts.product_id', 'products.id')
                    ->where('carts.user_id',$user_id)
                    ->get();
        return view('frontend.cart.cart',compact('products'));
    }

    public function AddtoCart(Request $request){

        if (Auth::check()) {
                
            $existingCartlist = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($existingCartlist) {
                // $existingCartlist->delete();

                $notification = array(
                    'message' => 'This Product Already Added',
                    'alert' => 'error'
                );
                return response()->json([
                    'notification_response' => $notification
                ]);

            } else {
                $cartlist = Cart::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $request->product_id,
                    'qty' => $request->qty,
                    'product_price' => $request->currentPrice,
                ]);
                $cartcount = Cart::count();
                
                $count = array(
                    'count' => $cartcount
                );
                $notification = array(
                    'message' => 'Added to Cart',
                    'alert' => 'success'
                );
                
                return response()->json([
                    'count_response' => $count,
                    'notification_response' => $notification
                ]);
            }
        } else {
            $notification = array(
                'message' => 'Please Login First',
                'alert' => 'error'
            );

            return response()->json([
                'response' => $notification
            ]);
        }

    }

    public function CartProductdelete($id){

        Cart::where('product_id',$id)->delete();

        $notification = array(
            'message' => 'Product Deleted',
            'alert' => 'success'
        );    
        
        return response()->json([
            'notification_response' => $notification
        ]);
    }

    
}
