@extends('app')
@section('title')
    スポット情報編集
@endsection
@section('content')
    <a href="{{ route('spot_index') }}">戻る</a>

    <form action="{{ route('spot_update',$spot->id) }}" method="post">
        @csrf
        @method("patch")
        イベント名：
        <select name="event_id">
            @foreach ($events as $event)
                <option {{ $event->id == $spot->event_id && 'selected' }} 
                    value={{ $event->id }}>{{ $event->name }}</option>
            @endforeach
        </select>
        スポット名： <input type="text" name="name" value={{$spot->name}}>
        スポット詳細テキスト <input type="text" name="description" value={{$spot->description}}>
        スポット位置情報（ｘ）： <input type="number" name="location_x" value={{$spot->location_x}}>
        スポット位置情報（ｙ）： <input type="number" name="location_y" value={{$spot->location_y}}>
        スポット画像URL <input type="text" name="images" value={{$spot->images}}>
        <button>更新</button>
    </form>

    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif

    @if (session('message'))
        <p style="color: orange">{{ session('message') }}</p>
    @endif
@endsection
