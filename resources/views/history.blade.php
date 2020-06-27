@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="">
       <div class="mx-auto" style="max-width:1200px">
           <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:24px 0px;">
           {{ Auth::user()->name }}さんの購入履歴</h1>

            <div class="">
                <div>
                    @if($my_histories->isNotEmpty())
                    @foreach($my_histories as $my_history)
                        <div class="mycart_box">
                            {{ $my_history->stock->name }}<br>
                            {{ number_format($my_history->stock->fee) }}円<br>
                            <img src="/image/{{ $my_history->stock->imgpath }}" alt="" class="incart"><br>
                            {{ $my_history->created_at }}に購入<br>
                            <form action="{{ route('mycart.review') }}" method="POST" class="mb-2 mt-2">
                                @csrf
                                <input type="hidden" name="stock_id" value="{{ $my_history->stock->id }}">
                                <input type="submit" value="商品レビューを投稿">
                            </form>
                            <form action="/mycart" method="POST">
                                @csrf
                                <input type="hidden" name="stock_id" value="{{ $my_history->stock->id }}">
                                <input type="submit" value="もう一度購入する。">
                            </form>
                        </div>
                    @endforeach
                    @else
                        <p class="text-center">購入履歴はありません。</p>
                    @endif
                </div>
                <div class="text-center" style="width: 200px;margin: 20px auto;">
                {{ $my_histories->links() }}
                </div>
                <a href="/">商品一覧へ</a>
            </div>
       </div>
   </div>
</div>
@endsection