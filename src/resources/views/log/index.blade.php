@extends('app')
@section('title')
    スポット情報一覧
@endsection
@section('content')
    <a href="{{ route('dash') }}">戻る</a>

    <table class="table">
        <tr>
            <td>ログID</td>
            <td>イベント名</td>
            <td>スポット名</td>
            <td>操作種別</td>
            <td>操作日時</td>
            <td></td>
        </tr>
        @foreach ($logs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->event->name }}</td>
                <td>{{ isset($log->spot) ? $log->spot->name : '' }}</td>
                <td>{{ $log->operation_type }}</td>
                <td>{{ $log->created_at }}</td>
                <td>
                    <form action="{{ route('log_destroy', $log->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button onclick="deleteConfirm(event)">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    <script>
        function deleteConfirm(event) {
            event.preventDefault()
            if (confirm("削除してよろしいですか？")) {
                event.target.closest("form").submit()
            }
        }
    </script>
@endsection
