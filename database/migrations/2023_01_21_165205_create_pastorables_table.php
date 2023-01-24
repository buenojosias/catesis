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
        Schema::create('pastorables', function (Blueprint $table) {
            $table->integer("pastoral_id")->constrained()->cascadeOnDelete();
            $table->integer("pastorable_id")->constrained()->cascadeOnDelete();
            $table->string("pastorable_type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pastorables');
    }
};
