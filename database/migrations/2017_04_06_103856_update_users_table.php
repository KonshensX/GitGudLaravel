<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Delete the profile table and update the controllers
        Schema::drop('profiles');

        Schema::table('users', function (Blueprint $table) {
            $table->string('fullname')->nullable();
            $table->date('birthdate')->nullable();
            $table->text('about')->nullable();
            $table->string('location')->nullable();
            $table->string('avatar_name')->nullable();
            $table->string('banner_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
