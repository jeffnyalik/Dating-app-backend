<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('known_as')->nullable();
            $table->text('bio')->nullable();
            $table->string('looking_for')->nullable();
            $table->string('last_active')->nullable();
            $table->string('interests')->nullable();
            $table->string('language')->nullable();
            $table->string('city')->nullable();
            $table->string('dob')->nullable();
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
