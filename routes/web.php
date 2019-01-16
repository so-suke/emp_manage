<?php

Route::get('/', function () {
  return view('welcome');
});

Route::get('/login', function () {
  return view('contents.login');
})->name('login');

Route::get('/logout', 'ActionController@logout')->name('logout');

Route::get('/menu', 'ActionController@toMenu')->name('menu');
Route::get('/regist_new_employee', 'ActionController@toRegistNewEmployee')->name('regist_new_employee');
Route::get('/to_update_emp_info/{emp_no?}', 'ActionController@toUpdateEmpInfo')->name('to_update_emp_info');
Route::get('/skill_list', 'ActionController@toSkillList')->name('skill_list');
Route::get('/employee_list', 'ActionController@toEmployeeList')->name('employee_list');
Route::get('/employee_detail/{emp_no}', 'ActionController@toEmployeeDetail')->name('employee_detail');

Route::post('/login', 'ActionController@login')->name('login');
Route::post('/regist_new_employee', 'ActionController@registNewEmployee')->name('regist_new_employee');
Route::post('/to_update_emp_info', 'ActionController@toUpdateEmpInfo')->name('to_update_emp_info');
Route::post('/update_emp_info', 'ActionController@updateEmpInfo')->name('update_emp_info');

// Ajaxリクエスト系
Route::get('/ajax_q/get_employees', 'ActionController@ajaxGetEmployees');
Route::get('/ajax_q/get_with_skill_employees', 'ActionController@ajaxGetWithSkillEmployees');
Route::post('/ajax_q/get_employee_by_emp_no', 'ActionController@ajaxGetEmpInfoByEmpNo');
Route::post('/ajax_q/delete_employee_by_emp_no', 'ActionController@ajaxDeleteEmployeeByEmpNo');
Route::post('/ajax_q/save_name_filter_val', 'ActionController@ajaxSaveNameFilterVal');
Route::post('/ajax_q/get_skills', 'ActionController@ajaxGetSkills');
Route::post('/ajax_q/regist_new_employee', 'ActionController@ajaxRegistNewEmployee');