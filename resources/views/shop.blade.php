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
                                    <img src="/image/{{$stock->imgpath}}" alt="" class="incart">
                                    <br>
                                    {{$stock->detail}} <br>

                                    {{-- 追加 --}}
                                    
                                    {{-- ここはコントローラー側でifで処理を分岐させるのでは無くて、formを分離させましょう。
                                    理由としては、今後コントローラー側の処理が増えていくにつれて同一のメソッド内で全く違う画面のロジックをまとめて書くことになっているので
                                    分かりづらいコントローラーになってしまいます。 --}}
                                    <form action="mycart" method="post">
                                        @csrf
                                        <input type="hidden" name="stock_id" value="{{ $stock->id }}">
                                        <input type="submit" name="detail" value="商品詳細">
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
