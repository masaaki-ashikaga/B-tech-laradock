<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Thanks;

class ShopController extends Controller
{
    public function index()
    {
        $stocks = Stock::Paginate(6); //Eloquantで検索
        return view('shop', compact('stocks'));
    }

    public function myCart(Cart $cart)
    {
        $data = $cart->showCart();
        return view('mycart', $data);
    }

    public function selectItem(Request $request, Cart $cart)
    {
        //同じメソッド内に違う処理を分岐させるのはなるべくやめたほうが良きです。理由はViewの方に書いてます。
        if($request->input('detail'))
        {
            $stock_id = $request->stock_id;
            //DBファサードを利用していますが、これくらいだとEloquantが良いかもしれません。今後レビュー投稿などを紐づけて表示させるので記述が冗長になってきます。
            //ただNGな訳ではないです。
            $items = DB::table('stocks')->where('id', $stock_id)->get();
            return view('detail', compact('items'));
        } 
        elseif($request->input('putIn'))
        {
            $stock_id = $request->stock_id;
            $message = $cart->addCart($stock_id);
            $data = $cart->showCart();
            return view('mycart', $data)->with('message', $message);
        }
    }

    // public function addMycart(Request $request, Cart $cart)
    // {
    //     $stock_id = $request->stock_id;
    //     $message = $cart->addCart($stock_id);
    //     $data = $cart->showCart();
    //     return view('mycart', $data)->with('message', $message);
    // }

    public function deleteCart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->deleteCart($stock_id);
        $data = $cart->showCart();
        return view('mycart', $data)->with('message', $message);
    }

    public function checkout(Request $request, Cart $cart)
    {
        $user_id = Auth::user();
        $mail_data['user'] = $user_id->name;
        $mail_data['checkout_items'] = $cart->checkoutCart();
        Mail::to($user_id->email)->send(new Thanks($mail_data));
        return view('checkout');
    }
}
