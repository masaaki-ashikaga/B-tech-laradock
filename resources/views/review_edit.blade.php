@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品レビュー編集</h1>
    <h3 class="ml-5">この商品をレビュー</h3>
    @foreach($items as $item)
    <div class="d-flex mb-5 ml-5">
        <img src="/image/{{ $item->imgpath }}" style="height: 200px;" class="mr-5">
        <div  class="align-self-end">
            <h4 style="color:#555555;">{{ $item->name }}</h4>
            <p style="color:#555555;">{{ $item->detail }}</p>
        </div>
    </div>
    @endforeach

    <div class="container">
        @foreach($reviews as $review)
        <form action="{{ route('update.review') }}" method="POST" class="form-horizontal">
            @csrf
            <input type="hidden" name="id" value="{{ $review->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="stock_id" value="{{ $stock_id }}">
            <div class="form-group">
                <label for="evaluation">評価</label>
                @error('evaluation')
                    <div class="text-danger mb-1">{{ $message }}</div>
                @enderror
                <div class="row">
                    <select name="evaluation">
                        <option value="">評価を選択して下さい</option>
                        <option value="1" @if($review->evaluation === 1) selected @endif>★</option>
                        <option value="2" @if($review->evaluation === 2) selected @endif>★★</option>
                        <option value="3" @if($review->evaluation === 3) selected @endif>★★★</option>
                        <option value="4" @if($review->evaluation === 4) selected @endif>★★★★</option>
                        <option value="5" @if($review->evaluation === 5) selected @endif>★★★★★</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="review_title">レビュータイトル</label>
                @error('review_title')
                    <div class="text-danger mb-1">{{ $message }}</div>
                @enderror
                <div class="row">
                    <input type="text" name="review_title" class="form-control" value="{{ $review->review_title }}">
                </div>
            </div>
            <div class="form-group">
                <label for="review">商品レビュー</label>
                @error('review')
                    <div class="text-danger mb-1">{{ $message }}</div>
                @enderror
                <div class="row">
                    <textarea name="review" class="form-control" style="height: 10em;">{{ $review->review }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="review_imgpath">実際に届いた商品の画像を追加する</label>
                @error('review_imgpath')
                    <div class="text-danger mb-1">{{ $message }}</div>
                @enderror
                <div class="row">
                    <input type="file" name="review_imgpath">
                </div>
            </div>
            <p><input type="submit" value="追加する" class="btn btn-danger btn-lg buy-btn"></p>
        </form>
        @endforeach
    </div>
@endsection
