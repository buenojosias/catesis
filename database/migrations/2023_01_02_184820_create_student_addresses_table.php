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
        Schema::create('student_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parish_id')->constrained();
            $table->foreignId('community_id')->nullable()->constrained();
            $table->string('address', 128);
            $table->string('complement')->nullable();
            $table->string('district', 64);
            $table->string('city', 64)->default('Curitiba');
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
        Schema::dropIfExists('student_addresses');
    }
};
