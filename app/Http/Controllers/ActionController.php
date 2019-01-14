<?php

namespace App\Http\Controllers;
use App\Employee;
use App\mDepartments;
use App\mJobs;
use App\mSkills;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ActionController extends Controller {

	public function logout(Request $request) {
		$request->session()->flush();

		return redirect()->route('login');
	}

  //ログイン時の認証
  public function login(Request $request) {
    $emp_no = $request->emp_no;
    $password = $request->password;

    //ログイン入力項目から該当社員が存在するかどうか判断。
    $employee_obj = Employee::where('emp_no', $emp_no)
      ->where('password', $password);
    $is_exists_emp = $employee_obj->exists();

    try {
      if ($is_exists_emp !== true) {
        throw new Exception('社員番号またはパスワードが正しくありません。');
      }
      //ログイン社員取得
      $login_employee = $employee_obj->first();
      //ログイン社員をセッションに保存
      $request->session()->put('login_employee', $login_employee);
    } catch (Exception $e) {
      $err_msg = $e->getMessage();
      return view('contents.login', [
        'err_msg' => $err_msg,
      ]);
    }

    if ($login_employee->is_admin === '1') {
      //もし管理者の場合
      return redirect()->route('employee_list');
    } else {
      //todo 一般社員の場合、社員詳細画面に遷移させる。
			dd('一般社員の場合についての処理は、また未作成となっています。');
    }
  }

  //メニュー画面へ遷移させる。
  public function toMenu(Request $request) {
    $login_employee = $request->session()->get('login_employee');
    return view('contents.menu', [
      'display_name' => 'メニュー',
      'login_employee' => $login_employee,
    ]);
  }

  //社員一覧画面へ遷移させる。
  public function toEmployeeList(Request $request) {
    $login_employee = $request->session()->get('login_employee');
    return view('contents.employee_list', [
      'display_name' => '社員一覧',
      'login_employee' => $login_employee,
    ]);
  }

  //【社員一覧画面】全社員情報を取得します。社員一覧情報関数内で使用します。
  public function _getAllEmployees() {
    $employees = Employee::select(DB::raw("e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, md.name as 'dept_name', mj.name as 'job_name'"))
      ->from(DB::raw("(select emp_no, is_admin, name_sei, name_mei, name_sei_kana, name_mei_kana, m_dept_id, m_job_id
					from employees
					where is_deleted = false) as e"))
      ->join('m_departments as md', 'e.m_dept_id', '=', 'md.id')
      ->join('m_jobs as mj', 'e.m_job_id', '=', 'mj.id')
      ->get();

    return $employees;
  }

  //【社員一覧画面】社員一覧情報を取得します。(社員名絞り込み条件を考慮しています。)
  public function ajaxGetEmployees(Request $request) {
    $employees = [];
    $has_filter_name_sei = $request->session()->has('filter_name_sei');
    $has_filter_name_mei = $request->session()->has('filter_name_mei');
    $filter_name_sei = $request->session()->get('filter_name_sei');
    $filter_name_mei = $request->session()->get('filter_name_mei');

    if ($has_filter_name_sei !== true && $has_filter_name_mei !== true) {
      //絞り込み条件が設定されていない場合です。全社員情報取得となります。
      $employees = $this->_getAllEmployees();
    } else if ($has_filter_name_sei === true && $has_filter_name_mei !== true) {
      //名前(姓)のみ設定されている場合です。名前(姓)のみ絞り込み条件とします。
      $employees = Employee::select(DB::raw("e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, md.name as 'dept_name', mj.name as 'job_name'"))
        ->from(DB::raw("(select emp_no, is_admin, name_sei, name_mei, name_sei_kana, name_mei_kana, m_dept_id, m_job_id
					from employees
					where name_sei = '$filter_name_sei' and is_deleted = false) as e"))
        ->join('m_departments as md', 'e.m_dept_id', '=', 'md.id')
        ->join('m_jobs as mj', 'e.m_job_id', '=', 'mj.id')
        ->get();
    } else if ($has_filter_name_sei !== true && $has_filter_name_mei === true) {
      //名前(名)のみ設定されている場合です。名前(名)のみ絞り込み条件とします。
      $employees = Employee::select(DB::raw("e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, md.name as 'dept_name', mj.name as 'job_name'"))
        ->from(DB::raw("(select emp_no, is_admin, name_sei, name_mei, name_sei_kana, name_mei_kana, m_dept_id, m_job_id
					from employees
					where name_mei = '$filter_name_mei' and is_deleted = false) as e"))
        ->join('m_departments as md', 'e.m_dept_id', '=', 'md.id')
        ->join('m_jobs as mj', 'e.m_job_id', '=', 'mj.id')
        ->get();
    } else if ($has_filter_name_sei === true && $has_filter_name_mei === true) {
      //名前(姓)と名前(名)の両方が設定されている場合です。両方を絞り込み条件とします。
      $employees = Employee::select(DB::raw("e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, md.name as 'dept_name', mj.name as 'job_name'"))
        ->from(DB::raw("(select emp_no, is_admin, name_sei, name_mei, name_sei_kana, name_mei_kana, m_dept_id, m_job_id
					from employees
					where name_sei = '$filter_name_sei' and name_mei = '$filter_name_mei' and is_deleted = false) as e"))
        ->join('m_departments as md', 'e.m_dept_id', '=', 'md.id')
        ->join('m_jobs as mj', 'e.m_job_id', '=', 'mj.id')
        ->get();
    } else {
      $employees = $this->_getAllEmployees();
    }

    return response()->json([
      'employees' => $employees,
      'filter_name_sei' => $filter_name_sei === null ? '' : $filter_name_sei,
      'filter_name_mei' => $filter_name_mei === null ? '' : $filter_name_mei,
    ]);
  }

  //(社員一覧画面)社員番号から検索された社員情報を削除するため。
  public function ajaxDeleteEmployeeByEmpNo(Request $request) {
    $employee = Employee::where('emp_no', $request->will_delete_emp_no)
      ->first();

    $employee->is_deleted = true;
    $employee->save();

    return response()->json([
      'result' => 'delete success',
    ]);
  }

  //【社員一覧画面】社員名の絞り込みに使用する、絞り込み条件の保存をします。
  // 絞り込み条件は、後で、社員一覧情報の取得時に使用します。
  public function ajaxSaveNameFilterVal(Request $request) {
    $name_sei = $request->name_sei;
    $name_mei = $request->name_mei;

    $request->session()->put('filter_name_sei', $name_sei);
    $request->session()->put('filter_name_mei', $name_mei);

    return response()->json([
      'result' => 'success',
    ]);
  }

  // 社員新規登録画面へ遷移させる。
  public function toRegistNewEmployee(Request $request) {
    $login_employee = $request->session()->get('login_employee');
    $m_deps = mDepartments::get();
    $m_jobs = mJobs::get();
    return view('contents.regist_new_employee', [
      'display_name' => '社員新規登録',
      'login_employee' => $login_employee,
      'm_deps' => $m_deps,
      'm_jobs' => $m_jobs,
    ]);
  }

  //(社員新規登録画面)社員新規登録関数,
  public function registNewEmployee(Request $request) {
		// (TODO: バリデーションのエラーメッセージがlaravelデフォルトのままなので後で作ります。)
		//バリデーション。requiredは、空欄不可の意味。分かりにくいと思う所には、コメントしております。
    $validatedData = $request->validate([
      'emp_no' => 'required|unique:employees|gt:0', //社員番号->重複不可
      'name_sei' => 'required|max:5',
      'name_mei' => 'required|max:9',
      'name_sei_kana' => 'required|regex:/^[ぁ-ゞ]+$/u|max:8', //名前(姓)かな->ひらがなのみ
      'name_mei_kana' => 'required|max:19',
      'pw' => 'required|min:4|numeric|unique:employees,password', //パスワード->重複不可
      'select_dept_id' => 'required|exists:m_departments,id', //選択された部署id->DB内に存在しているかどうか。
      'select_job_id' => 'required|exists:m_jobs,id', //選択された役職id->DB内に存在しているかどうか。
      'choose_gender' => 'required',
      'hired_at' => 'required',
      'birth_at' => 'required',
      'remarks' => '',
    ], [
      'name_sei_kana.regex' => 'Please enter your employee name (Kana) in Kana.',
    ]);

    $emp = new Employee;
    $emp->emp_no = $request->emp_no;
    $emp->is_admin = $request->is_admin === null ? 0 : 1;
    $emp->name_sei = $request->name_sei;
    $emp->name_mei = $request->name_mei;
    $emp->name_sei_kana = $request->name_sei_kana;
    $emp->name_mei_kana = $request->name_mei_kana;
    $emp->password = $request->pw;
    $emp->m_dept_id = $request->select_dept_id;
    $emp->m_job_id = $request->select_job_id;
    $emp->gender = $request->choose_gender;
    $emp->hired_at = $request->hired_at;
    $emp->birth_at = $request->birth_at;
    $emp->remarks = $request->remarks;
    $emp->is_deleted = 0; //初期の削除フラグは偽
    $emp->save();

    $login_employee = $request->session()->get('login_employee');
    return view('contents.regist_new_employee', [
      'display_name' => '社員新規登録',
      'login_employee' => $login_employee,
    ]);
  }

  //スキル一覧画面へ遷移させる。
  public function toSkillList(Request $request) {
    $login_employee = $request->session()->get('login_employee');
    return view('contents.skill_list', [
      'display_name' => 'スキル一覧',
      'login_employee' => $login_employee,
    ]);
  }

  public function updateEmpInfo(Request $request) {
    $validatedData = $request->validate([
      'emp_no' => [
        'required',
        Rule::unique('employees')->ignore($request->emp_no, 'emp_no'),
        'gt:0',
      ],
      'name_sei' => 'required|max:5',
      'name_mei' => 'required|max:9',
      'name_sei_kana' => 'required|regex:/^[ぁ-ゞ]+$/u|max:8', //名前(姓)かな->ひらがなのみ
      'name_mei_kana' => 'required|max:19',
      'pw' => [
        'required',
        'min:4',
        'numeric',
        Rule::unique('employees', 'password')->ignore($request->emp_no, 'emp_no'),
      ],
      'select_dept_id' => 'required|exists:m_departments,id', //選択された部署id->DB内に存在しているかどうか。
      'select_job_id' => 'required|exists:m_jobs,id', //選択された役職id->DB内に存在しているかどうか。
      'choose_gender' => 'required',
      'hired_at' => 'required',
      'birth_at' => 'required',
      'remarks' => '',
    ], [
      'name_sei_kana.regex' => 'Please enter your employee name (Kana) in Kana.',
    ]);

    $emp = Employee::find($request->emp_no);
    $emp->is_admin = $request->is_admin === null ? 0 : 1;
    $emp->name_sei = $request->name_sei;
    $emp->name_mei = $request->name_mei;
    $emp->name_sei_kana = $request->name_sei_kana;
    $emp->name_mei_kana = $request->name_mei_kana;
    $emp->password = $request->pw;
    $emp->m_dept_id = $request->select_dept_id;
    $emp->m_job_id = $request->select_job_id;
    $emp->gender = $request->choose_gender;
    $emp->hired_at = $request->hired_at;
    $emp->birth_at = $request->birth_at;
    $emp->remarks = $request->remarks;
    $emp->is_deleted = 0; //初期の削除フラグは偽
    $emp->save();

    return redirect()->route('to_update_emp_info', ['emp_no' => $emp->emp_no]);
  }

  // 社員情報更新画面へ遷移させる。
  public function toUpdateEmpInfo(Request $request, $emp_no = null) {
    //社員詳細画面から遷移してくる時は、社員番号が渡されてくる。更新対象の社員情報を画面に渡す。
    //メニュー画面から遷移してくる時は、社員番号が渡されない。更新対象の社員をユーザーに画面内で選択してもらいます。
    $will_update_emp_no = $request->emp_no;
    $detail_emp = null; //画面に表示する社員情報
    if ($will_update_emp_no !== null) {
      $detail_emp = Employee::select(DB::raw("e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, e.password, e.gender, e.hired_at, e.birth_at, e.remarks, e.m_dept_id, e.m_job_id, md.name as 'dept_name', mj.name as 'job_name'"))
        ->from(DB::raw("(select emp_no, is_admin, name_sei, name_mei, name_sei_kana, name_mei_kana, password, gender, hired_at, birth_at, remarks, m_dept_id, m_job_id
					from employees
					where emp_no = $will_update_emp_no) as e"))
        ->join('m_departments as md', 'e.m_dept_id', '=', 'md.id')
        ->join('m_jobs as mj', 'e.m_job_id', '=', 'mj.id')
        ->first();
    }

    $dpts = mDepartments::select('id', 'name')
      ->get();
    $jobs = mJobs::select('id', 'name')
      ->get();

    $login_employee = $request->session()->get('login_employee');
    return view('contents.update_emp_info', [
      'display_name' => '社員情報更新',
      'login_employee' => $login_employee,
      'will_update_emp_no' => $will_update_emp_no,
      'detail_emp' => $detail_emp,
      'dpts' => $dpts,
      'jobs' => $jobs,
    ]);
  }

  //(社員情報更新画面)社員番号から検索された社員情報を表示するため。
  public function ajaxGetEmpInfoByEmpNo(Request $request) {
    $emp_no = $request->emp_no;
    $employee = Employee::select(DB::raw("e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, md.name as 'dept_name', mj.name as 'job_name'"))
      ->from(DB::raw("(select emp_no, is_admin, name_sei, name_mei, name_sei_kana, name_mei_kana, m_dept_id, m_job_id
					from employees
					where emp_no = $emp_no) as e"))
      ->join('m_departments as md', 'e.m_dept_id', '=', 'md.id')
      ->join('m_jobs as mj', 'e.m_job_id', '=', 'mj.id')
      ->first();
    return response()->json([
      'employee' => $employee,
    ]);
  }

  //社員詳細画面へ遷移させる。
  public function toEmployeeDetail(Request $request) {
    $emp_no = $request->emp_no;

    //所属部署と役職を付属させた、社員情報を取得。
    $detail_emp = Employee::select(DB::raw("e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, e.password, e.gender, e.hired_at, e.birth_at, e.remarks, md.name as 'dept_name', mj.name as 'job_name'"))
      ->from(DB::raw("(select emp_no, is_admin, name_sei, name_mei, name_sei_kana, name_mei_kana, password, gender, hired_at, birth_at, remarks, m_dept_id, m_job_id
					from employees
					where emp_no = $emp_no) as e"))
      ->join('m_departments as md', 'e.m_dept_id', '=', 'md.id')
      ->join('m_jobs as mj', 'e.m_job_id', '=', 'mj.id')
      ->first();

    $login_employee = $request->session()->get('login_employee');
    return view('contents.employee_detail', [
      'display_name' => '社員詳細',
      'login_employee' => $login_employee,
      'emp_no' => $emp_no,
      'detail_emp' => $detail_emp,
    ]);
  }

  //(未完成)
  public function ajaxGetWithSkillEmployees(Request $request) {
    $employees = [];
    $skill_keyword = $request->skill_keyword;

    Employee::select(DB::raw("e.emp_no, e.is_admin, e.name_sei, e.name_mei, e.name_sei_kana, e.name_mei_kana, md.name as 'dept_name', mj.name as 'job_name'"))
      ->from(DB::raw("(select emp_no, is_admin, name_sei, name_mei, name_sei_kana, name_mei_kana, m_dept_id, m_job_id
					from employees
					where is_deleted = false) as e"))
      ->join('m_departments as md', 'e.m_dept_id', '=', 'md.id')
      ->join('m_jobs as mj', 'e.m_job_id', '=', 'mj.id')
      ->get();

    return response()->json([
      'employees' => $employees,
      'skill_keyword' => $skill_keyword === null ? '' : $skill_keyword,
    ]);
  }

  //全スキル情報を取得します。
  public function ajaxGetSkills(Request $request) {
    $skills = mSkills::select('id', 'keyword')->get();

    return response()->json([
      'skills' => $skills,
    ]);
  }
}
