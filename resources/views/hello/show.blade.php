@extends('layouts.helloapp')

@section('title', 'database')

@section('menubar')
@parent
詳細画面
@endsection

@section('content')
@if($items != null)
    @foreach($items as $item)
        <table width="500px">
            <tr>
                <th width="50px">name:</th><td width="60px">{{ $item->name }}</td>
                <th width="50px">mail:</th><td width="100px">{{ $item->mail }}</td>
                <th width="50px">age:</th><td width="50px">{{ $item->age }}</td>
            </tr>
        </table>
    @endforeach
@endif
@endsection


@section('footer')
copyright@ashikaga20200312
@endsection

