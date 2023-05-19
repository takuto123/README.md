@extends('layout')

@section('title', '在庫管理システム')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <h2>在庫管理一覧</h2>
            @if(session('err_msg'))
                <p class="text-danger">
                    {{ session('err_msg') }}
                </p>
            @endif
            <div class="row">
                <div class="col-md-6">
                <p>ログインユーザー: {{ auth()->user()->name }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">ログアウト</button>
                    </form>
                </div>
            </div>
            <table class="table table-striped">
                <tr>
                    <th>在庫名</th>
                    <th>金額</th>
                    <th>個数</th>
                    <th>発注状態</th>
                    <th></th>
                    <th></th>
                </tr>
                @forelse($zaikos as $zaiko)
                <tr>
                        <td><a href="/zaiko/{{$zaiko->id}}">{{$zaiko->name}}</a></td>
                        <td>{{$zaiko->kakaku}}円</td>
                        <td>{{$zaiko->kazu}}個</td>
                        <td>{{$zaiko->jyoukyou}}</td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='/zaiko/edit/{{ $zaiko->id }}'">編集</button></td>
                        <form method="POST" action="{{ route('delete',$zaiko->id) }}" onSubmit="return checkDelete()">
                            @csrf
                            <td><button type="submit" class="btn btn-primary">削除</button></td>          
                        </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">データがありません</td>
                    </tr>
                @endforelse
            </table>
            <a href="{{ route('zaikos.export') }}">CSV出力</a>

        </div>
    </div>

    <script>
        function checkDelete() {
            if (window.confirm('削除してよろしいですか？')) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
