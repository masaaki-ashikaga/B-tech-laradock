<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $stocks = Stock::Paginate(6); //Eloquantで検索
        return view('shop', compact('stocks'));
    }

    public function myCart(Cart $cart)
    {
        $my_carts = $cart->showCart();
        return view('mycart', compact('my_carts'));
    }

    public function addMycart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->addCart($stock_id);
        $my_carts = $cart->showCart();
        return view('mycart', compact('my_carts', 'message'));
    }

    public function deleteCart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->deleteCart($stock_id);
        $my_carts = $cart->showCart();
        return view('mycart', compact('my_carts', 'message'));
    }
}
