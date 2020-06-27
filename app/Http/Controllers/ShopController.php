<?php

namespace App\Http\Controllers;

use App\User;
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

    public function stockDetail(Request $request, Review $review)
    {
        $stock_id = $request->stock_id;
        $items = Stock::where('id', $stock_id)->get();  //Eloquentでデータ取得
        $reviews = Review::where('stock_id', $stock_id)->get();
        return view('detail', compact('items', 'reviews'));
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

    public function mycartHistory()
    {
        $user_id = Auth::id();
        $my_histories = History::where('user_id', $user_id)->paginate(5);
        return view('history', compact('my_histories'));
    }

    public function mycartReview(Request $request)
    {
        $stock_id = $request->stock_id;
        $items = Stock::where('id', $stock_id)->get();
        return view('review', compact('items', 'stock_id'));
    }

    public function postReview(ReviewRequest $request, Review $review)
    {
        $review->reviewCreate($request);
        return redirect('/');
    }

    public function editReview(Request $request)
    {
        $stock_id = $request->stock_id;
        $items = Stock::where('id', $stock_id)->get();
        $reviews = Review::where('id', $request->id)->get();
        return view('review_edit', compact('items', 'reviews', 'stock_id'));
    }

    public function updateReview(ReviewRequest $request, Review $review)
    {
        $id = $request->id;
        $review->reviewUpdate($id, $request);
        return redirect('/');
    }

    public function deleteReview(Request $request)
    {
        Review::find($request->id)->delete();
        return redirect('/');
    }
}