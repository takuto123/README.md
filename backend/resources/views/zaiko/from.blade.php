@extends('layout')
@section('title', '在庫登録')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>在庫登録フォーム</h2>
        <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()">
            @csrf
            <div class="form-group">
                <label for="title">
                    在庫名
                </label>
                <input
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
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
                <input
                    id="kakaku"
                    name="kakaku"
                    class="form-control"
                    value="{{ old('kakaku') }}"
                    type="text"
                >
                @error('kakaku')
                <span style="color:red;">値段を数値で入力してください</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">
                    個数
                </label>
                <input
                    id="kazu"
                    name="kazu"
                    class="form-control"
                    value="{{ old('kazu') }}"
                    type="text"
                >
                @error('kazu')
                <span style="color:red;">個数を数値で入力してください</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">発注状態</label>
                <select name="jyoukyou" class="form-select">
                    <option value="">発注状態を選んでください</option>
                    <option value="発注確認">発注確認</option>
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
                >{{ old('shosai') }}</textarea>
                @error('shosai')
                <span style="color:red;">詳細を入力してください</span>
                @enderror
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('zaikos') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    在庫を登録する
                </button>

            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('登録してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection