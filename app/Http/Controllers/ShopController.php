<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Cart;
use App\Models\History;
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

    public function addMycart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->addCart($stock_id);
        $data = $cart->showCart();
        return view('mycart', $data)->with('message', $message);
    }

    public function stockDetail(Request $request)
    {
        $items = Stock::where('id', $request->stock_id)->get();  //Eloquentでデータ取得
        return view('detail', compact('items'));
    }

    public function deleteCart(Request $request, Cart $cart)
    {
        $stock_id = $request->stock_id;
        $message = $cart->deleteCart($stock_id);
        $data = $cart->showCart();
        return view('mycart', $data)->with('message', $message);
    }

    public function checkout(Request $request, Cart $cart, History $history)
    {
        $user_id = Auth::id();
        $mycart_items = Cart::where('user_id', $user_id)->get();
        $history->addHistory($mycart_items);
        $mail_data['user'] = Auth::user()->name;
        $mail_data['checkout_items'] = $cart->checkoutCart();
        Mail::to(Auth::user()->email)->send(new Thanks($mail_data));
        return view('checkout');
    }

    public function stockAdd()
    {
        return view('create');
    }

    public function stockCreate(StockRequest $request, Stock $stock)
    {
        $stock->create($request);
        return redirect('/');
    }

    public function mycartHistory(History $history)
    {
        $user_id = Auth::id();
        $data['my_histories'] = History::where('user_id', $user_id)->paginate(5);
        return view('history', $data);
    }
}
