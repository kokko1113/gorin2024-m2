@extends('app')
@section('title')
    イベント情報新規登録
@endsection
@section('content')
    <a href="{{ route('spot_index') }}">戻る</a>

    <form action="{{ route('spot_store') }}" method="post">
        @csrf
        イベント名：
        <select name="event_id">
            @foreach ($events as $event)
                <option value={{$event->id}}>{{$event->name}}</option>
            @endforeach    
        </select> 
        スポット名： <input type="text" name="name">
        スポット詳細テキスト <input type="text" name="description">
        スポット位置情報（ｘ）： <input type="number" name="location_x">
        スポット位置情報（ｙ）： <input type="number" name="location_y">
        スポット画像URL <input type="text" name="images">
        <button>登録</button>
    </form>

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    
    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection
