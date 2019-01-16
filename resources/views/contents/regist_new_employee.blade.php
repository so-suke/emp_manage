@extends('layouts.app')

@section('csses')
@parent
<link rel="stylesheet" href="{{ asset('css/contents/regist_new_employee.css') }}">
@endsection

@section('content')

<div class="mt-3 d-flex">
  <a class="btn btn-primary mr-2" href="{{ route('menu') }}">メニュー</a>
  <a class="btn btn-primary mr-2" href="{{ route('employee_list') }}">社員一覧</a>
  <a class="btn btn-secondary ml-auto" id="insertTestData" @click="insertTestData">【テスト用】入力補助</a>
</div>

<div class="alert alert-danger mt-3" v-if="Object.keys(errs).length > 0">
  <ul>
    <li v-for="err in errs">@{{ err[0] }}</li>
  </ul>
</div>

{{-- vuejsのアニメーション記法です。 --}}
<transition name="fade">
  <div class="alert alert-success mt-3" v-if="is_regist_success === true">
    <span>登録が完了しました。</span>
  </div>
</transition>

<form class="mt-3" action="{{ route('regist_new_employee') }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="empNo">社員番号</label>
    <input type="number" class="form-control col-1" id="empNo" name="emp_no" ref="emp_no" value="{{old('emp_no')}}" required>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="true" id="isAdminCheck" name="is_admin" ref="is_admin">
      <label class="form-check-label" for="isAdminCheck">管理者設定する場合は、ここにチェックを入れて下さい。</label>
    </div>
  </div>

  <div class="form-group">
    <label for="nameSei">社員名(姓：漢字)</label>
    <input type="text" class="form-control" id="nameSei" name="name_sei" placeholder="社員名(姓：漢字)" ref="name_sei" value="{{old('name_sei')}}" required>
  </div>

  <div class="form-group">
    <label for="nameMei">社員名(名：漢字)</label>確認
    <input type="text" class="form-control" id="nameMei" name="name_mei" placeholder="社員名(名：漢字)" ref="name_mei" value="{{old('name_mei')}}" required>
  </div>

  <div class="form-group">
    <label for="nameSeiKana">社員名(姓：かな)</label>
    <input type="text" class="form-control" id="nameSeiKana" name="name_sei_kana" placeholder="社員名(姓：かな)" ref="name_sei_kana" value="{{old('name_sei_kana')}}" required>
  </div>

  <div class="form-group">
    <label for="nameMeiKana">社員名(名：かな)</label>
    <input type="text" class="form-control" id="nameMeiKana" name="name_mei_kana" placeholder="社員名(名：かな)" ref="name_mei_kana" value="{{old('name_mei_kana')}}" required>
  </div>

  <div class="form-group">
    <label for="password">パスワード</label>
    <input type="text" class="form-control" id="password" name="pw" placeholder="パスワード" ref="pw" value="{{old('pw')}}" required>
  </div>

  <div class="form-group">
    <label for="dept">所属部署</label>
    <select class="custom-select my-1 mr-sm-2" id="dept" name="select_dept_id" ref="select_dept_id" required>
      <option selected>選択して下さい</option>
      @foreach ($m_deps as $m_dep)
      <option value="{{ $m_dep->id }}" @if(old('select_dept_id')==="$m_dep->id" ) selected @endif>{{ $m_dep->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="job">役職</label>
    <select class="custom-select my-1 mr-sm-2" id="job" name="select_job_id" ref="select_job_id" required>
      <option selected>選択して下さい</option>
      @foreach ($m_jobs as $m_job)
      <option value="{{ $m_job->id }}" @if(old('select_job_id')==="$m_job->id" ) selected @endif>{{ $m_job->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label class="d-block">性別</label>
    <div class="form-check form-check-inline">
      <input class="form-check-input choose_gender-js" type="radio" name="choose_gender" id="genderMale" value="male" required @if(old('choose_gender')==='male' ) checked @endif>
      <label class="form-check-label" for="genderMale">男性</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input choose_gender-js" type="radio" name="choose_gender" id="genderFemale" value="famale" @if(old('choose_gender')==='famale' ) checked @endif>
      <label class="form-check-label" for="genderFemale">女性</label>
    </div>
  </div>
  <div class="form-group">
    <label for="hiredAt">入社日</label>
    <input type="text" class="form-control" id='hiredAt' name="hired_at" ref="hired_at" value="{{old('hired_at')}}">
  </div>
  <div class="form-group">
    <label for="birthAt">生年月日</label>
    <input type="text" class="form-control" id='birthAt' name="birth_at" ref="birth_at" value="{{old('birth_at')}}">
  </div>
  <div class="form-group">
    <label for="remarks">備考</label>
    <textarea class="form-control" id="remarks" rows="3" name="remarks" ref="remarks" value="{{old('remarks')}}"></textarea>
  </div>
  <button type="button" class="btn btn-primary" @click="registNewEmp">登録</button>
  {{-- <button type="submit" class="btn btn-primary">登録</button> --}}
</form>
@endsection

@section('scripts')
@parent
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<script src="{{ asset('js/cmn/datepicker_for_form.js') }}"></script>
<script src="{{ asset('js/contents/regist_new_employee.js') }}"></script>
@endsection
