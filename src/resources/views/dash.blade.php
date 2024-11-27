@extends('app')
@section('title')
    管理画面
@endsection
@section('content')
    <a href="{{route("event_index")}}" class="btn">イベント情報一覧</a>
    <a href="{{route("spot_index")}}" class="btn">スポット情報一覧</a>
    <a href="{{route("log_index")}}" class="btn">ログ情報一覧</a>
@endsection