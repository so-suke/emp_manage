@extends('layouts.app')

@section('csses')
@parent
<link rel="stylesheet" href="{{ asset('css/contents/menu.css') }}">
@endsection

@section('content')
<ul class="mt-3 menuBtnsGrid">
  <li>
    <a class="btn btn-danger d-block" href="{{ route('logout') }}">ログアウト</a>
  </li>
  <li>
    <a class="btn btn-primary d-block" href="{{ route('employee_list') }}">社員一覧</a>
  </li>
  <li>
    <a class="btn btn-primary d-block" href="{{ route('regist_new_employee') }}">社員新規登録</a>
  </li>
  <li>
    <a class="btn btn-primary d-block notouch" href="{{ route('skill_list') }}">スキル一覧</a>
  </li>
  <li class="btn btn-primary notouch">スキル登録</li>
  <li>
    <a class="btn btn-primary d-block" href="{{ route('to_update_emp_info') }}">社員情報更新</a>
  </li>
</ul>
@endsection

@section('scripts')
@parent
@endsection
