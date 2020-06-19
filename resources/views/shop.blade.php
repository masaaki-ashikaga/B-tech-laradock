@extends('layouts.app')

@section('content')
<div class="container-fluid">
   <div class="">
       <div class="mx-auto" style="max-width:1200px">
           <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品一覧</h1>
           <div class="">
               <div class="d-flex flex-row flex-wrap">
                    @foreach($stocks as $stock)
                        <div class="col-xs-6 col-sm-4 col-md-4 ">
                            <div class="mycart_box">
                                {{$stock->name}} <br>
                                {{$stock->fee}}円<br>
                                <img src="/image/{{$stock->imgpath}}" alt="" class="incart" >
                                <br>
                                {{$stock->detail}} <br>
                                {{-- 追加 --}}
                                <form action="{{ route('stock.detail') }}" method="post" class="mb-1">
                                    @csrf
                                    <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                    <input type="submit" name="detail" value="商品詳細">
                                </form>
                                <form action="{{ route('mycart.add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                    <input type="submit" name="putIn" value="カートに入れる">
                                </form>

                                {{-- ここまで --}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center" style="width: 200px;margin: 20px auto;">
                {{  $stocks->links()}} 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection