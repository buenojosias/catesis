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
        Schema::create('kinship_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kinship_id')->constrained()->onDelete('cascade');
            $table->string('profession')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->boolean('catechizing')->nullable();
            $table->boolean('has_baptism')->nullable();
            $table->boolean('has_eucharist')->nullable();
            $table->boolean('has_chrism')->nullable();
            $table->boolean('attends_church')->nullable();
            $table->boolean('is_tither')->nullable(); // dizimista
            $table->string('musical_instrument')->nullable();
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
        Schema::dropIfExists('kinship_profiles');
    }
};
