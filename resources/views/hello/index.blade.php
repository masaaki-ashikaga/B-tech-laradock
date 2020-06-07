@extends('layouts.helloapp')

@section('title', 'database')

@section('menubar')
@parent
一覧画面
@endsection

@section('content')
<table>
    <tr><th>Name</th><th>Mail</th><th>Age</th></tr>
    @foreach($items as $item)
    <tr>
        <td>{{ $item->name }}</td>
        <td>{{ $item->mail }}</td>
        <td>{{ $item->age }}</td>
    </tr>
    @endforeach
</table>
@endsection


@section('footer')
copyright@ashikaga20200312
@endsection

