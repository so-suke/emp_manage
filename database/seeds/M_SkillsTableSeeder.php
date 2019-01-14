<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class M_SkillsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    DB::table('m_skills')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    $m_skill_keywords = ['c', 'c++', 'c#', 'java', 'javascript', 'php', 'python', 'ruby'];
    foreach ($m_skill_keywords as $key => $m_skill_keyword) {
      DB::table('m_skills')->insert([
        'keyword' => $m_skill_keyword,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
  }
}
