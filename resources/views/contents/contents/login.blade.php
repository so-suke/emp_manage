@extends('layouts.app')

@section('content')
<div class="mt-5">
  <form class="d-flex flex-column align-items-center" action="{{ route('login') }}" method="POST">
    @csrf
    @if (isset($err_msg))
    <div class="alert alert-danger" role="alert">
      {{ $err_msg }}
    </div>
    @endif
    <div class="form-group col-5">
      <label for="emp_no">社員番号</label>
      <input type="number" class="form-control" ref="emp_no" name="emp_no" placeholder="社員番号を入力して下さい。" required>
    </div>
    <div class="form-group col-5">
      <label for="password">パスワード</label>
      <input type="text" class="form-control" ref="password" name="password" placeholder="4桁のパスワードを入力して下さい。" maxlength="4" required>
      {{-- <input type="password" class="form-control" id="password" placeholder="4桁のパスワードを入力して下さい。" maxlength="4"> --}}
    </div>
    <button type="submit" class="btn btn-primary">ログイン</button>
  </form>
</div>
@endsection

@section('scripts')
@parent
@endsection
