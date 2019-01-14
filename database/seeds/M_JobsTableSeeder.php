<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class M_JobsTableSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    DB::table('m_jobs')->truncate();
    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    $m_job_names = ['一般社員', '主任', '係長', '課長'];
    foreach ($m_job_names as $key => $m_job_name) {
      DB::table('m_jobs')->insert([
        'name' => $m_job_name,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      ]);
    }
  }
}
