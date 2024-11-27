@extends('app')
@section('title')
    イベント情報編集
@endsection
@section('content')
    <a href="{{ route('event_index') }}">戻る</a>

    <form action="{{ route('event_update',$event->id) }}" method="post">
        @csrf
        @method("patch")
        イベント名： <input type="text" name="name" value={{$event->name}}>
        開催場所： <input type="text" name="place" value={{$event->place}}>
        開催日： <input type="date" name="date" value={{$event->date}}>
        イベントマップURL： <input type="text" name="map_image" value={{$event->map_image}}>
        <button>更新</button>
    </form>

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
    
    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif
@endsection
