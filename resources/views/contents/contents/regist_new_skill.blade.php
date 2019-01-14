@extends('layouts.app')

@section('csses')
@parent
{{-- <link rel="stylesheet" href="{{ asset('css/contents/regist_new_employee.css') }}"> --}}
@endsection

@section('content')
<form>
  <div class="input-group mb-3">
    <input type="text" class="form-control" placeholder="検索対象の社員番号">
    <div class="input-group-append">
      <button class="btn btn-outline-secondary" type="button">検索</button>
    </div>
  </div>
  {{-- タッチ不可にする --}}
  <div class="row">
    <div class="col-1">
      <label for="">社員番号</label>
      <input type="number" class="form-control">
    </div>
    <div class="col">
      <label for="">社員名</label>
      <input type="text" class="form-control">
    </div>
  </div>
	{{-- label for id修正 --}}
  <div class="form-group">
    <label for="kw">キーワード</label>
    <input type="text" class="form-control" id="kw" placeholder="キーワード" required>
  </div>

  <div class="form-group">
    <label for="expYear">経験年数</label>
    <input type="text" class="form-control" id="expYear" placeholder="経験年数" required>
  </div>

  <div class="form-group">
    <label for="nameSeiKana">自己評価</label>
    <input type="text" class="form-control" id="nameSeiKana" placeholder="自己評価" required>
  </div>

  <div class="form-group">
    <label for="nameSeiKana">外部評価</label>
    <input type="text" class="form-control" id="nameSeiKana" placeholder="外部評価" required>
  </div>

  <div class="form-group">
    <label for="nameSeiKana">詳細情報</label>
    <input type="text" class="form-control" id="nameSeiKana" placeholder="詳細情報" required>
  </div>

  <div class="form-group">
    <label for="nameSeiKana">営業メモ</label>
    <input type="text" class="form-control" id="nameSeiKana" placeholder="営業メモ" required>
  </div>

  <button type="submit" class="btn btn-primary">登録</button>
</form>
@endsection

@section('scripts')
@parent
{{-- <script src="{{ asset('js/cmn/datepicker_for_form.js') }}"></script> --}}
@endsection
