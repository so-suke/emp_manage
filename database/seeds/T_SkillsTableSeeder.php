<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class T_SkillsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    DB::table('t_skills')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    $m_skill_names = ['C', 'C++', 'C#', 'Java', 'JavaScript', 'php', 'Python', 'Ruby'];
    // $m_skill_namesの長さ分ループを回して、マスタスキルidの配列を作成。($m_skill_ids)
    $m_skill_ids = [];
		$m_skill_ids_len = count($m_skill_names);
    for ($m_skill_id = 1; $m_skill_id <= $m_skill_ids_len; $m_skill_id++) {
      $m_skill_ids[] = $m_skill_id;
    }

    $detaile_info = 'サンプル詳細情報です。';
    $sales_note = 'サンプル営業メモです。';
    $now_fmt = Carbon::now()->format('Y-m-d H:i:s');

		//経験年数、自己評価、外部評価、は、ランダムな値です。
    for ($emp_no = 1; $emp_no <= 4; $emp_no++) {
      //1社員につき３スキルを付ける。そのための、スキルids作成
      shuffle($m_skill_ids);
      for ($idx = 0; $idx < 3; $idx++) {
        DB::table('t_skills')->insert([
          'emp_no' => $emp_no,
          'm_skill_id' => $m_skill_ids[$idx],
          'exp_year' => rand(1, 5),
          'self_evaluate' => rand(1, 5),
          'ext_evaluate' => rand(1, 5),
          'detaile_info' => $detaile_info,
          'sales_note' => $sales_note,
          'created_at' => $now_fmt,
          'updated_at' => $now_fmt,
        ]);
      }
    }
  }
}
