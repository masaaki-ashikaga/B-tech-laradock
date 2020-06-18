<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Cart;
use App\Http\Requests\StockRequest;
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
        if($request->input('detail'))
        {
            $stock_id = $request->stock_id;
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

    public function stockAdd()
    {
        return view('create');
    }

    public function stockCreate(StockRequest $request, Stock $stock)
    {
        // $stock = new Stock;
        // $stock->name = $request->name;
        // $stock->detail = $request->detail;
        // $stock->fee = $request->fee;
        // $stock->imgpath = $request->imgpath;
        // $stock->save();
        $stock->create($request);
        return redirect('/');
    }
}
