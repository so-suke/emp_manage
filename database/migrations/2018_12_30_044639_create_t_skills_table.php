<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSkillsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('t_skills', function (Blueprint $table) {
      $table->increments('id');
      $table->unsignedInteger('emp_no');
      $table->unsignedInteger('m_skill_id');
      $table->unsignedTinyInteger('exp_year');
      $table->unsignedTinyInteger('self_evaluate');
      $table->unsignedTinyInteger('ext_evaluate');
      $table->string('detaile_info', 500);
      $table->string('sales_note', 500);
      $table->timestamps();

      $table->foreign('emp_no')->references('emp_no')->on('employees');
      $table->foreign('m_skill_id')->references('id')->on('m_skills');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('t_skills');
  }
}
