<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run() {
    $this->call([
      M_DepartmentsTableSeeder::class,
      M_JobsTableSeeder::class,
      M_SkillsTableSeeder::class,
      EmployeesTableSeeder::class,
      T_SkillsTableSeeder::class,
    ]);
  }
}
