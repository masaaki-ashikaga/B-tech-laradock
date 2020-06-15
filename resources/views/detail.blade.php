@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品詳細</h1>
        @foreach($items as $item)
        <div class="mycartbox text-center">
            <p style="color: #555555; font-size: 1.2em; padding-top: 20px;">{{ $item->name }}</p>
            <p><img src="/image/{{ $item->imgpath }}" class="detail"></p>
            <p style="color: #555555; font-size: 1.7em;">{{ $item->detail }}</p>
            <form action="mycart" method="POST">
                @csrf
                <input type="hidden" name="stock_id" value="{{ $item->id }}">
                <input type="submit" class="btn btn-danger btn-lg buy-btn" name="putIn" value="カートに入れる">
            </form>
        </div>
    </div>
</div>
    @endforeach
    
    @endsection
