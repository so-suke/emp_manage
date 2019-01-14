@extends('layouts.app')

@section('csses')
@parent
<link rel="stylesheet" href="{{ asset('css/contents/update_emp_info.css') }}">
@endsection

@section('content')

<div class="mt-3 d-flex">
  <a class="btn btn-primary mr-2" href="{{ route('menu') }}">メニュー</a>
</div>

@if (count($errors) > 0)
<div class="alert alert-danger mt-3">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form class="mt-3" action="{{ route('to_update_emp_info') }}" method="POST">
  @csrf
  <div class="form-group">
    <label class="d-block" for="empNum">更新対象社員を<span class="font-weight-bold">社員番号</span>から検索します。
		※社員番号を検索すると、更新項目が表示され、自動的に入力されます。</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">社員番号</span>
      </div>
      <input type="number" class="form-control col-1" id="empNum" value="{{ $will_update_emp_no ?? '' }}" name="emp_no" min="1" max="999" ref="willUpdateEmpNo" required>
      <div class="input-group-append">
        <button type="submit" class="btn btn-primary">検索</button>
      </div>
    </div>
  </div>
</form>

<form action="{{ route('update_emp_info') }}" method="POST" ref="updateEmpInfoForm" v-show="isInputedEmpNo">
  @csrf
  <input type="hidden" name="emp_no" :value="update_emp_no">
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="is_admin" id="isAdminCheck" {{ isset($detail_emp) ? ($detail_emp->is_admin ? "checked" : "") : '' }}>
      <label class="form-check-label" for="isAdminCheck">管理者設定する場合は、ここにチェックを入れて下さい。</label>
    </div>
  </div>

  <div class="form-group">
    <label for="nameSei">社員名(姓：漢字)</label>
    <input type="text" class="form-control" id="nameSei" name="name_sei" value="{{ $detail_emp->name_sei ?? '' }}" required>
  </div>

  <div class="form-group">
    <label for="nameMei">社員名(名：漢字)</label>
    <input type="text" class="form-control" id="nameMei" name="name_mei" value="{{ $detail_emp->name_mei ?? '' }}" required>
  </div>

  <div class="form-group">
    <label for="nameSeiKana">社員名(姓：かな)</label>
    <input type="text" class="form-control" id="nameSeiKana" name="name_sei_kana" value="{{ $detail_emp->name_sei_kana ?? '' }}" required>
  </div>

  <div class="form-group">
    <label for="nameMeiKana">社員名(名：かな)</label>
    <input type="text" class="form-control" id="nameMeiKana" name="name_mei_kana" value="{{ $detail_emp->name_mei_kana ?? '' }}" required>
  </div>

  <div class="form-group">
    <label for="password">パスワード</label>
    <input type="text" class="form-control" id="password" name="pw" value="{{ $detail_emp->password ?? '' }}" required>
  </div>

  <div class="form-group">
    <label for="empNum">所属部署</label>
    <select class="custom-select my-1 mr-sm-2" name="select_dept_id">
      <option>選択して下さい</option>
      @foreach ($dpts as $dpt)
      <option value="{{ $dpt->id }}" {{ isset($detail_emp) ? ($dpt->id == $detail_emp->m_dept_id ? "selected" : "") : '' }}>{{ $dpt->name ?? '' }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="empNum">役職</label>
    <select class="custom-select my-1 mr-sm-2" name="select_job_id">
      <option>選択して下さい</option>
      @foreach ($jobs as $job)
      <option value="{{ $job->id }}" {{ isset($detail_emp) ? ($job->id == $detail_emp->m_job_id ? "selected" : "") : '' }}>{{ $job->name ?? '' }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label class="d-block">性別</label>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="choose_gender" id="genderMale" value="male" required {{ isset($detail_emp) ? ($detail_emp->gender === 'male' ? "checked" : "") : '' }}>
      <label class="form-check-label" for="genderMale">男性</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="choose_gender" id="genderFemale" value="famale" {{ isset($detail_emp) ? ($detail_emp->gender === 'female' ? "checked" : "") : '' }}>
      <label class="form-check-label" for="genderFemale">女性</label>
    </div>
  </div>
  <div class="form-group">
    <label for="hiredAt">入社日</label>
    <input type="text" class="form-control" id='hiredAt' name="hired_at" value="{{ $detail_emp->hired_at ?? '' }}">
  </div>
  <div class="form-group">
    <label for="birthAt">生年月日</label>
    <input type="text" class="form-control" id='birthAt' name="birth_at" value="{{ $detail_emp->birth_at ?? '' }}">
  </div>
  <div class="form-group">
    <label for="remarks">備考</label>
    <textarea class="form-control" id="remarks" rows="3" name="remarks">{{ $detail_emp->remarks ?? '' }}</textarea>
  </div>
  <button type="button" class="btn btn-primary" @click="showUpdateEmpModal">更新</button>
</form>

<div class="modal fade" id="updateEmpModal" tabindex="-1" role="dialog" aria-labelledby="updateEmpModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateEmpModalLabel">本当に更新しますか？</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-primary" @click="updateEmpInfo">更新する</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">更新しない</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
<script src="{{ asset('js/contents/update_emp_info.js') }}"></script>
<script src="{{ asset('js/cmn/datepicker_for_form.js') }}"></script>
@endsection
