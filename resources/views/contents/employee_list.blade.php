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
  <span class="d-block">社員名から一覧表示の絞り込み</span>
  <div class="d-flex align-items-center">
    <div class="form-group d-flex m-0">
      <label for="empNameSei" class="col-form-label mr-2">姓</label>
      <div class="">
        <input type="text" class="form-control" id="empNameSei" ref="filterEmpNameSei" placeholder="社員名(姓)">
      </div>
    </div>
    <div class="form-group d-flex m-0 ml-2">
      <label for="empNameMei" class="col-form-label mr-2">名</label>
      <div class="">
        <input type="text" class="form-control" id="empNameMei" ref="filterEmpNameMei" placeholder="社員名(名)">
      </div>
    </div>
    <button class="btn btn-primary ml-4" @click="filterName">絞り込み</button>
  </div>
</div>
<div class="mt-4">
  <table class="table table-sm table-bordered text-center table-fixed">
    <thead>
      <tr>
        <th class="col-md-2" scope="col">
          <span class="d-block">管理者フラグ</span>
          <span class="d-block">真:◯, 偽:×</span>
        </th>
        <th class="col-md-2" scope="col">社員番号</th>
        <th class="col-md-2" scope="col">社員名</th>
        <th class="col-md-2" scope="col">所属部署</th>
        <th class="col-md-2" scope="col">役職</th>
        <th class="col-md-2" scope="col">オプション</th>
      </tr>
    </thead>
    <tbody class="emp_list_wrap">
      <tr v-for="employee in employees">
        <td class="col-md-2" scope="row">@{{ employee.is_admin === '1' ? '◯' : '×' }}</th>
        <td class="col-md-2">@{{ employee.emp_no }}</td>
        <td class="col-md-2">@{{ employee.name_sei }} @{{ employee.name_mei }}</td>
        <td class="col-md-2">@{{ employee.dept_name }}</td>
        <td class="col-md-2">@{{ employee.job_name }}</td>
        <td class="d-flex justify-content-around col-md-2">
          <a :href="'/emp_manage/public/employee_detail/' + employee.emp_no" class="btn btn-sm btn-success">詳細</a>
          <button class="btn btn-sm btn-danger" @click="showDeleteEmpModal" :data-emp-no="employee.emp_no">削除</button>
        </td>
      </tr>
    </tbody>
  </table>

  <div class="modal fade" id="deleteEmpModal" tabindex="-1" role="dialog" aria-labelledby="deleteEmpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteEmpModalLabel">本当に削除しますか？</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table mb-0" v-if="will_delete_emp !== null">
            <thead>
              <tr>
                <th scope="col">社員番号</th>
                <th scope="col">社員名</th>
                <th scope="col">所属部署</th>
                <th scope="col">役職</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">@{{ will_delete_emp.emp_no }}</th>
                <td>@{{ will_delete_emp.name_sei }} @{{ will_delete_emp.name_mei }}</td>
                <td>@{{ will_delete_emp.dept_name }}</td>
                <td>@{{ will_delete_emp.job_name }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-primary" @click="deleteEmp">削除する</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">削除しない</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ asset('js/contents/employee_list.js') }}"></script>
@endsection
