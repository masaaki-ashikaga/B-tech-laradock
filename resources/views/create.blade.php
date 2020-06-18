@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <h1 style="color:#555555; text-align:center; font-size:1.2em; padding:24px 0px; font-weight:bold;">商品追加</h1>

    <div class="container">
        <form action="{{ route('stock.create') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <label for="name">商品名</label>
                @error('name')
                    <div class="text-danger mb-1">{{ $message }}</div>
                @enderror
                <div class="row">
                    <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="detail">商品詳細</label>
                @error('detail')
                    <div class="text-danger mb-1">{{ $message }}</div>
                @enderror
                <div class="row">
                    <input type="text" name="detail" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="fee">金額</label>
                @error('fee')
                    <div class="text-danger mb-1">{{ $message }}</div>
                @enderror
                <div class="row">
                    <input type="text" name="fee" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="imgpath">商品イメージ</label>
                @error('imgpath')
                    <div class="text-danger mb-1">{{ $message }}</div>
                @enderror
                <div class="row">
                    <input type="file" name="imgpath">
                </div>
            </div> 
            <p><input type="submit" value="追加する" class="btn btn-danger btn-lg buy-btn"></p>
        </form>
    </div>

    
@endsection
