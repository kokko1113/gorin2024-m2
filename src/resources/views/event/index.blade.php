@extends('app')
@section('title')
    イベント情報一覧
@endsection
@section('content')
    <a href="{{route("dash")}}">戻る</a>
    <a href="{{route("event_create")}}">イベント情報新規登録</a>

    <table class="table">
        <tr>
            <td>イベント名</td>
            <td>開催場所</td>
            <td>開催日</td>
            <td></td>
            <td></td>
        </tr>
        @foreach ($events as $event)
            <tr>
                <td>{{$event->name}}</td>    
                <td>{{$event->place}}</td>    
                <td>{{$event->date}}</td>    
                <td><a href="{{route("event_edit",$event->id)}}">編集</a></td>
                <td>
                    <form action="{{route("event_destroy",$event->id)}}" method="post">
                        @csrf
                        @method("delete")
                        <button onclick="deleteConfirm(event)">削除</button>
                    </form>
                </td>
            </tr>            
        @endforeach
    </table>

    <script>
        function deleteConfirm(event){
            event.preventDefault()
            if(confirm("削除してよろしいですか？")){
                event.target.closest("form").submit()
            }
        }
    </script>
@endsection