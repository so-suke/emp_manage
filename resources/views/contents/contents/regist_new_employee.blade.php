@extends('layouts.app')

@section('csses')
@parent
<link rel="stylesheet" href="{{ asset('css/contents/regist_new_employee.css') }}">
@endsection

@section('content')

<div class="mt-3 d-flex">
  <a class="btn btn-primary mr-2" href="{{ route('menu') }}">メニュー</a>
  <a class="btn btn-primary mr-2" href="{{ route('employee_list') }}">社員一覧</a>
</div>

@if (count($errors) > 0)
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('regist_new_employee') }}" method="POST">
  @csrf
  <button type="submit" class="btn btn-primary">登録</button>
  <div class="form-group">
    <label for="empNo">社員番号</label>
    <input type="number" class="form-control col-1" id="empNo" name="emp_no" value="{{old('emp_no')}}">
    {{-- <input type="number" class="form-control col-1" id="empNo" name="emp_no" required value="{{old('emp_no')}}"> --}}
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="true" id="isAdminCheck" name="is_admin">
      <label class="form-check-label" for="isAdminCheck">管理者設定する場合は、ここにチェックを入れて下さい。</label>
    </div>
  </div>

  <div class="form-group">
    <label for="nameSei">社員名(姓：漢字)</label>
    <input type="text" class="form-control" id="nameSei" name="name_sei" placeholder="社員名(姓：漢字)" required>
  </div>

  <div class="form-group">
    <label for="nameMei">社員名(名：漢字)</label>確認
    <input type="text" class="form-control" id="nameMei" name="name_mei" placeholder="社員名(名：漢字)" required>
  </div>

  <div class="form-group">
    <label for="nameSeiKana">社員名(姓：かな)</label>
    <input type="text" class="form-control" id="nameSeiKana" name="name_sei_kana" placeholder="社員名(姓：かな)" required>
  </div>

  <div class="form-group">
    <label for="nameMeiKana">社員名(名：かな)</label>
    <input type="text" class="form-control" id="nameMeiKana" name="name_mei_kana" placeholder="社員名(名：かな)" required>
  </div>

  <div class="form-group">
    <label for="password">パスワード</label>
    <input type="text" class="form-control" id="password" name="password" placeholder="パスワード" required>
  </div>

  <div class="form-group">
    <label for="empNum">所属部署</label>
    <select class="custom-select my-1 mr-sm-2" id="dept" name="select_dept_id">
      <option selected>選択して下さい</option>
      <option value="1">営業部</option>
      <option value="2">総務部</option>
    </select>
  </div>

  <div class="form-group">
    <label for="empNum">役職</label>
    <select class="custom-select my-1 mr-sm-2" id="job" name="select_job_id">
      <option selected>選択して下さい</option>
      <option value="1">一般社員</option>
      <option value="2">主任</option>
    </select>
  </div>

  <div class="form-group">
    <label class="d-block">性別</label>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="choose_gender" id="genderMale" value="male" required>
      <label class="form-check-label" for="genderMale">男性</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="choose_gender" id="genderFemale" value="famale">
      <label class="form-check-label" for="genderFemale">女性</label>
    </div>
  </div>
  <div class="form-group">
    <label for="hiredAt">入社日</label>
    <input type="text" class="form-control" id='hiredAt' name="hired_at">
  </div>
  <div class="form-group">
    <label for="birthAt">生年月日</label>
    <input type="text" class="form-control" id='birthAt' name="birth_at">
  </div>
  <div class="form-group">
    <label for="remarks">備考</label>
    <textarea class="form-control" id="remarks" rows="3" name="remarks"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">登録</button>
</form>
@endsection

@section('scripts')
@parent
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<script src="{{ asset('js/cmn/datepicker_for_form.js') }}"></script>
<script src="{{ asset('js/contents/regist_new_employee.js') }}"></script>
@endsection
