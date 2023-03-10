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
        Schema::create('church_details', function (Blueprint $table) {
            $table->id();
            $table->morphs('detailable');
            $table->string('parson', 60)->nullable();
            $table->string('address', 120);
            $table->string('district', 60);
            $table->string('zip_code', 9);
            $table->string('city', 60);
            $table->string('site')->nullable();
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
        Schema::dropIfExists('church_details');
    }
};
