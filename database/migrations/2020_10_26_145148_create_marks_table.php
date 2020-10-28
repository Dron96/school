<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pupil_id');
            $table->unsignedBigInteger('teacher_id');
            $table->integer('mark');
            $table->unsignedBigInteger('subject_id');
            $table->timestamps();

            $table->foreign('pupil_id')->references('id')->on('users')
                ->onDelete('Cascade');
            $table->foreign('teacher_id')->references('id')->on('users')
                ->onDelete('Cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')
                ->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('marks');
    }
}
