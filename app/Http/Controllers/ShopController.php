<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Cart;
use App\Models\History;
use App\Models\Review;
use App\Http\Requests\StockRequest;
use App\Http\Requests\ReviewRequest;
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

    public function mycartReview(Request $request)
    {
        $stock_id = $request->stock_id;
        $items = Stock::where('id', $stock_id)->get();
        return view('review', compact('items', 'stock_id'));
    }

    public function postReview(Request $request, Review $review)
    {
        $review->reviewCreate($request);
        return redirect('/');
    }
}