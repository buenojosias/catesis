<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->enum('gender', ['male','female','other']);
            $table->string('naturalness')->nullable();
            $table->boolean('has_baptism');
            $table->date('baptism_date')->nullable();
            $table->string('baptism_church')->nullable();
            $table->boolean('married_parents');
            $table->string('health_problems')->nullable();
            $table->string('school')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_details');
    }
};
