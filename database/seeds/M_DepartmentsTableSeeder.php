<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class M_DepartmentsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    DB::table('m_departments')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    $m_departments = [
      [
        'name' => '営業部',
      ],
      [
        'name' => '総務部',
      ],
      [
        'name' => '人事部',
      ],
      [
        'name' => '技術部',
      ],
      [
        'name' => '製造部',
      ],
    ];
    foreach ($m_departments as $key => $m_department) {
      DB::table('m_departments')->insert([
        'name' => $m_department['name'],
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
  }
}
