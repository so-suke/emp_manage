<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    DB::table('employees')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    $one_month_before_today_fmt = Carbon::now()->subMonth()->format('Y-m-d');
    $remarks = 'サンプル備考です。';
    $is_deleted = false;
    $birth_at = Carbon::now()->subYears(20)->format('Y-m-d');
    $now_fmt = Carbon::now()->format('Y-m-d H:i:s');

    //passwordは1000から1010まで, 入社日は皆, 一ヶ月前、歳は20歳、

    $gender_name_systems = [
      'male' => [
        'names' => ['佐藤 誠', '鈴木 誠', '田中 大輔', '高橋 大輔', '山本 大輔', '伊藤 大輔', '中村 誠', '小林 誠'],
        'kana_names' => ['さとう まこと', 'すずき まこと', 'たなか だいすけ', 'たかはし だいすけ', 'やまもと だいすけ', 'いとう だいすけ', 'なかむら まこと', 'こばやし まこと'],
      ],
      'female' => [
        'names' => ['鈴木 香織', '鈴木 恵子', '佐藤 沙織', '鈴木 あゆみ', '田中 真由美', '鈴木 美紀', '小林 裕子', '鈴木 友美', '佐藤 茜', '伊藤 彩', '佐藤 ひとみ'],
        'kana_names' => ['すずき かおり', 'すずき けいこ', 'さとう さおり', 'すずき あゆみ', 'たなか まゆみ', 'すずき みき', 'こばやし ゆうこ', 'すずき ともみ', 'さとう あかね', 'いとう あや', 'さとう ひとみ'],
      ],
    ];

    $employees = [];
    $password_seed = 1000;
    foreach ($gender_name_systems as $gender_key => $name_systems) {
      $names = $name_systems['names'];
      $kana_names = $name_systems['kana_names'];
      foreach ($names as $idx => $name) {
        $striped_names = explode(' ', $name);
        $striped_kana_names = explode(' ', $kana_names[$idx]);
        $employees[] = [
          'is_admin' => false,
          'name_sei' => $striped_names[0],
          'name_mei' => $striped_names[1],
          'name_sei_kana' => $striped_kana_names[0],
          'name_mei_kana' => $striped_kana_names[1],
          'password' => $password_seed++,
          'm_dept_id' => 1,
          'm_job_id' => 1,
          'gender' => $gender_key,
          'hired_at' => $one_month_before_today_fmt,
          'age' => 20,
          'remarks' => $remarks,
          'is_deleted' => $is_deleted,
        ];
      }

    }

    $employees[0]['is_admin'] = true;
    $employees[11]['is_admin'] = true;

    foreach ($employees as $key => $employee) {
      DB::table('employees')->insert([
        'is_admin' => $employee['is_admin'],
        'name_sei' => $employee['name_sei'],
        'name_mei' => $employee['name_mei'],
        'name_sei_kana' => $employee['name_sei_kana'],
        'name_mei_kana' => $employee['name_mei_kana'],
        'password' => $employee['password'],
        'm_dept_id' => $employee['m_dept_id'],
        'm_job_id' => $employee['m_job_id'],
        'gender' => $employee['gender'],
        'hired_at' => $employee['hired_at'],
        'birth_at' => $birth_at,
        'remarks' => $employee['remarks'],
        'is_deleted' => $employee['is_deleted'],
        'created_at' => $now_fmt,
        'updated_at' => $now_fmt,
      ]);
    }
  }
}
