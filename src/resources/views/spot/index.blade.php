@extends('app')
@section('title')
   スポット情報一覧
@endsection
@section('content')
    <a href="{{route("dash")}}">戻る</a>
    <a href="{{route("spot_create")}}">スポット情報新規登録</a>

    <table class="table">
        <tr>
            <td>イベント名</td>
            <td>スポット名</td>
            <td></td>
            <td></td>
        </tr>
        @foreach ($spots as $spot)
            <tr>
                <td>{{$spot->event->name}}</td>    
                <td>{{$spot->name}}</td>   
                <td><a href="{{route("spot_edit",$spot->id)}}">編集</a></td>
                <td>
                    <form action="{{route("spot_destroy",$spot->id)}}" method="post">
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