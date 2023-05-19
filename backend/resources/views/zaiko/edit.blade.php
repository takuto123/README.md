@extends('layout')
@section('title', '在庫編集')
@section('content')
@php
    $userRole = auth()->user()->role; // ログインユーザーの役割を取得
@endphp

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>在庫編集フォーム</h2>
        <form method="POST" action="{{ route('update') }}" onSubmit="return checkSubmit()">
            @csrf
            <input type="hidden" name="id" value="{{ $zaiko->id}}">
            <div class="form-group">
                <label for="title">
                    在庫名
                </label>
                <input
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ $zaiko->name }}"
                    type="text"
                >
                @error('name')
                <span style="color:red;">在庫名を20文字以内で入力してください</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">
                    値段
                </label>
                <textarea
                    id="kakaku"
                    name="kakaku"
                    class="form-control"
                    type="text"
                >{{ $zaiko->kakaku }}</textarea>
                @error('kakaku')
                <span style="color:red;">値段を数値で入力してください</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">
                    個数
                </label>
                <textarea
                    id="kazu"
                    name="kazu"
                    class="form-control"
                    type="text"
                >{{ $zaiko->kazu }}</textarea>
                @error('kazu')
                <span style="color:red;">個数を数値で入力してください</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">発注状態</label>
                <select name="jyoukyou" class="form-select">
                    <option value="">発注状態を選んでください</option>
                    <option value="発注確認"{{ $zaiko->jyoukyou == '発注確認' ? 'selected' : '' }}>発注確認</option>
                    <option value="発注状態"{{ $zaiko->jyoukyou == '発注状態' ? 'selected' : '' }}>発注状態</option>
                    <option value="発注済み"{{ $zaiko->jyoukyou == '発注済み' ? 'selected' : '' }}>発注済み</option>
                    <option value="発注受け取り済み"{{ $zaiko->jyoukyou == '発注受け取り済み' ? 'selected' : '' }}>発注受け取り済み</option>
                </select>
                @error('jyoukyou')
                    <span style="color:red;">状態を選択してください</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="title">
                    詳細
                </label>
                <textarea
                    id="shosai"
                    name="shosai"
                    class="form-control"
                    type="text"
                >{{ $zaiko->shosai }}</textarea>
                @error('shosai')
                <span style="color:red;">詳細を入力してください</span>
                @enderror
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('zaikos') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    更新する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection