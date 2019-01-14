@extends('layouts.app')

@section('csses')
@parent
<link rel="stylesheet" href="{{ asset('css/contents/emp_list.css') }}">
@endsection

@section('content')
<div class="mt-3 d-flex">
  <a class="btn btn-primary mr-2" href="{{ route('menu') }}">メニュー</a>
  <a class="btn btn-primary mr-2" href="{{ route('regist_new_employee') }}">社員新規登録</a>
</div>
<div class="mt-3">
  <span class="d-block">スキルキーワードから一覧表示の絞り込み</span>
  <div class="d-flex align-items-center">
    <div class="form-group d-flex m-0">
      <label for="skillKeyword" class="col-form-label mr-2">キーワード</label>
      <div class="">
        <div class="position-relative">
          <input type="text" class="form-control" id="skillKeyword" ref="skillKeyword" v-model="input_keyword" @input="searchCandidateKeyword" autocomplete="off" placeholder="キーワード">
          <ul class="autocomplete-results position-absolute border border-secondary p-2" v-show="is_open_candidate_keywords">
            <li class="autocomplete-result" v-for="(keyword, i) in candidate_keywords">
              <a class="d-block py-1" href="#" @click="setResult(keyword, $event)">@{{ keyword.name }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <button class="btn btn-primary ml-4">検索</button>
    {{-- <button class="btn btn-primary ml-4" @click="filter_skill">絞り込み</button> --}}
  </div>
</div>
<div class="mt-4">
  <table class="table table-sm table-bordered text-center table-fixed">
    <thead>
      <tr>
        <th class="col-md-2" scope="col">管理者フラグ</th>
        <th class="col-md-1" scope="col">社員番号</th>
        <th class="col-md-2" scope="col">社員名</th>
        <th class="col-md-2" scope="col">キーワード</th>
        <th class="col-md-1" scope="col">経験年数</th>
        <th class="col-md-1" scope="col">自己評価</th>
        <th class="col-md-1" scope="col">外部評価</th>
        <th class="col-md-2" scope="col">オプション</th>
      </tr>
    </thead>
    <tbody class="emp_list_wrap">
      <tr v-for="employee in employees">
        <td class="col-md-2" scope="row">◯</th>
        <td class="col-md-1">1</td>
        <td class="col-md-2">溝口　達也</td>
        <td class="col-md-2">Java</td>
        <td class="col-md-1">10年</td>
        <td class="col-md-1">3</td>
        <td class="col-md-1">5</td>
        <td class="d-flex justify-content-around col-md-2">
          <a href="" class="btn btn-sm btn-success">詳細</a>
          {{-- <a :href="'/employee_detail/' + employee.emp_no" class="btn btn-sm btn-success">詳細</a> --}}
          <button class="btn btn-sm btn-danger">更新</button>
          {{-- <button class="btn btn-sm btn-danger" :data-emp-no="employee.emp_no">更新</button> --}}
        </td>
      </tr>
      <tr v-for="employee in employees">
        <td class="col-md-2" scope="row">◯</th>
        <td class="col-md-1">1</td>
        <td class="col-md-2">溝口　達也</td>
        <td class="col-md-2">Java</td>
        <td class="col-md-1">10年</td>
        <td class="col-md-1">3</td>
        <td class="col-md-1">5</td>
        <td class="d-flex justify-content-around col-md-2">
          <a href="" class="btn btn-sm btn-success">詳細</a>
          {{-- <a :href="'/employee_detail/' + employee.emp_no" class="btn btn-sm btn-success">詳細</a> --}}
          <button class="btn btn-sm btn-danger">更新</button>
          {{-- <button class="btn btn-sm btn-danger" :data-emp-no="employee.emp_no">更新</button> --}}
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ asset('js/contents/skill_list.js') }}"></script>
@endsection
