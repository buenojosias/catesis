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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->string('naturalness', 64)->nullable()->after('birthday');
            $table->string('scholarity', 64)->nullable()->after('marital_status');
            $table->date('catechist_from')->nullable()->after('scholarity');
            $table->text('catechist_invitation')->nullable()->after('catechist_from');
            $table->text('encounter_preparation')->nullable()->after('catechist_invitation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            //
        });
    }
};
