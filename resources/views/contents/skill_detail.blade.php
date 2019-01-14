@extends('layouts.app')

@section('csses')
@parent
<link rel="stylesheet" href="{{ asset('css/contents/employee_detail.css') }}">
@endsection

@section('content')
<table class="table table-bordered mt-3">
  <thead>
    <tr>
      <th scope="col">管理者フラグ</th>
      <th scope="col">社員番号</th>
			{{-- TODO: かな　も表示 --}}
      <th scope="col">社員名</th>
      <th scope="col">キーワード</th>
      <th scope="col">経験年数</th>
      <th scope="col">自己評価</th>
      <th scope="col">外部評価</th>
      <th scope="col">詳細情報</th>
      <th scope="col">営業メモ</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">◯</th>
      <td>1</td>
      <td>
        <span class="d-block fz-07rem">みぞぐち せいや</span>
        <span class="d-block">溝口 聖夜</span>
      </td>
      <td>java</td>
      <td>10年</td>
      <td>3</td>
      <td>3</td>
      <td>
				サンプルの詳細情報となっております。
			</td>
      <td>
				サンプルの営業メモとなっております。
			</td>
    </tr>
  </tbody>
</table>
<table class="table table-bordered">
  <thead>
    <tr>
      <th class="h4 font-weight-bold" scope="col">詳細情報</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">
        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミー
      </th>
    </tr>
  </tbody>
</table>
@endsection

@section('scripts')
@parent
@endsection
