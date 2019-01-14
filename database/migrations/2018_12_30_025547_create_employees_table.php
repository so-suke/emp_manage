<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('employees', function (Blueprint $table) {
      $table->increments('emp_no');
      $table->boolean('is_admin');
      $table->string('name_sei', 20);
      $table->string('name_mei', 20);
      $table->string('name_sei_kana', 50);
      $table->string('name_mei_kana', 50);
      $table->string('password', 4);
      $table->unsignedInteger('m_dept_id');
      $table->unsignedInteger('m_job_id');
      $table->enum('gender', ['male', 'female']);
      $table->date('hired_at');
      $table->date('birth_at');
      $table->string('remarks', 300);
      $table->boolean('is_deleted');
      $table->timestamps();

      $table->foreign('m_dept_id')->references('id')->on('m_departments');
      $table->foreign('m_job_id')->references('id')->on('m_jobs');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('employees');
  }
}
