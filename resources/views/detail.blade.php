@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品詳細</h1>
    @foreach($items as $item)
    <div class="mycartbox text-center">
        <p style="color: #555555; font-size: 1.2em; padding-top: 20px;">{{ $item->name }}</p>
        <p><img src="/image/{{ $item->imgpath }}" class="detail"></p>
        <p style="color: #555555; font-size: 1.7em;">{{ $item->detail }}</p>
        <p style="color: #555555; font-size: 1.3em;">{{ $item->fee }}円</p>
        <form action="{{ route('mycart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="stock_id" value="{{ $item->id }}">
            <input type="submit" class="btn btn-danger btn-lg buy-btn" name="putIn" value="カートに入れる">
        </form>
    </div>
    @endforeach

    <div class="pt-5">
        @if($reviews->isNotEmpty())
        <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品レビュー</h1>
        @foreach($reviews as $review)
        <div class="stock_review mb-5">
            <div class="card m-auto" style="width: 600px;">
                <div class="card-header d-flex pb-0">
                    <h4 class="card-title">{{ $review->review_title }}</h4>
                    <p  class="ml-5">評価：<i class="fas fa-star" style="color: rgb(255, 162, 0);"></i>{{ $review->evaluation }}つ</p>
                </div>
                <div class="card-body pb-0">
                    <p class="card-text">{{ $review->review }}</p>
                    @isset($review->review_imgpath)
                    <p class="text-center"><img src="/image/{{ $review->review_imgpath }}" style="width: 500px;"></p>
                    @endisset
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <form action="{{ route('edit.review') }}" method="GET">
                                @csrf
                                @if(Auth::id() === $review['user_id'])
                                <input type="hidden" name="id" value="{{ $review->id }}">
                                <input type="hidden" name="stock_id" value="{{ $review->stock_id }}">
                                <input type="submit" name="review_edit" class="btn btn-primary ml-3" value="編集">
                                @endif
                            </form>
                            <form action="{{ route('delete.review') }}" method="POST">
                                @csrf
                                @if(Auth::id() === $review['user_id'])
                                <input type="hidden" name="id" value="{{ $review->id }}">
                                <input type="submit" name="review_delete" class="btn btn-danger ml-3" value="削除">
                                @endif
                            </form>
                        </div>
                        <div>
                            <p class="mb-0">{{ $review->created_at }}</p>
                            <p>ユーザー名：{{ $review->user->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <p class="text-center">商品レビューはありません。</p>
    @endif
</div>
@endsection
