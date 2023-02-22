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
        Schema::create('movementations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parish_id')->nullable()->constrained();
            $table->foreignId('community_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->tinyText('description');
            $table->foreignId('matriculation_id')->nullable()->constrained();
            $table->integer('amount');
            $table->integer('balance_before');
            $table->integer('balance_after');
            $table->date('date');
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
        Schema::dropIfExists('movementations');
    }
};
