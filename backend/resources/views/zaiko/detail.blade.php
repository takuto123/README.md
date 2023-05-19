@extends('layout')
@section('title','在庫詳細')
@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
      <h2>{{$zaiko->name}}</h2>
      <span>作成日：{{$zaiko->created_at}}</span>
      <span>更新日：{{$zaiko->updated_at}}</span>
      <p>{{$zaiko->shosai}}</p>
    
  </div>
</div>
@endsection
