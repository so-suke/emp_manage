@extends('layouts.app')

@section('csses')
@parent
<link rel="stylesheet" href="{{ asset('css/contents/employee_detail.css') }}">
@endsection

@section('content')
<div class="mt-3">
	<ul class="d-flex">
		<li>
			<a href="{{ route('menu') }}">メニュー</a>
		</li>
	</ul>
</div>

<div class="mt-3 d-flex">
  <a class="btn btn-primary" href="{{ route('update_emp_info', ['emp_no' => $emp_no]) }}">社員情報更新</a>
  <button class="btn btn-danger ml-2">社員削除</button>
</div>

<table class="table table-bordered mt-3">
  <thead>
    <tr>
      <th scope="col">社員番号</th>
      <th scope="col">管理者フラグ</th>
      <th scope="col">社員名</th>
      <th scope="col">パスワード</th>
      <th scope="col">所属部署</th>
      <th scope="col">役職</th>
      <th scope="col">入社日</th>
      <th scope="col">性別</th>
      <th scope="col">生年月日</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{ $detail_emp->emp_no }}</th>
      <td>◯</td>
      <td>
        <span class="d-block fz-07rem">{{ $detail_emp->name_sei_kana }} {{ $detail_emp->name_mei_kana }}</span>
        <span class="d-block">{{ $detail_emp->name_sei }} {{ $detail_emp->name_mei }}</span>
      </td>
      <td>{{ $detail_emp->password }}</td>
      <td>{{ $detail_emp->dept_name }}</td>
      <td>{{ $detail_emp->job_name }}</td>
      <td>{{ $detail_emp->hired_at }}</td>
      <td>{{ $detail_emp->gender }}</td>
      <td>{{ $detail_emp->birth_at }}</td>
    </tr>
  </tbody>
</table>
<table class="table table-bordered">
  <thead>
    <tr>
      <th class="h4 font-weight-bold" scope="col">備考</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">{{ $detail_emp->remarks }}</th>
    </tr>
  </tbody>
</table>
@endsection

@section('scripts')
@parent
{{-- <script src="{{ asset('js/contents/employee_detail.js') }}"></script> --}}
@endsection
