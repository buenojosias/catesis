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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parish_id')->constrained();
            $table->foreignId('community_id')->nullable()->constrained();
            $table->foreignId('grade_id')->constrained();
            $table->year('year');
            $table->tinyInteger('weekday');
            $table->time('time', $precision = 0);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('finished')->default(false);
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
        Schema::dropIfExists('groups');
    }
};
