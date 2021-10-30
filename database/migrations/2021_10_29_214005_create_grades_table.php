<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->bigInteger('task_id')->unsigned();
            $table->bigInteger('student_id')->unsigned();
            $table->decimal('value', 10, 2);
            $table->timestamps();

            $table->primary(['task_id', 'student_id']);
            $table->foreign('task_id')->on('tasks')->references('id');
            $table->foreign('student_id')->on('students')->references('ag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
