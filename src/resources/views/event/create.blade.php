@extends('app')
@section('title')
    イベント情報新規登録
@endsection
@section('content')
    <a href="{{ route('event_index') }}">戻る</a>

    <form action="{{ route('event_store') }}" method="post">
        @csrf
        イベント名： <input type="text" name="name">
        開催場所： <input type="text" name="place">
        開催日： <input type="date" name="date">
        イベントマップURL： <input type="text" name="map_image">
        <button>登録</button>
    </form>

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    
    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection
