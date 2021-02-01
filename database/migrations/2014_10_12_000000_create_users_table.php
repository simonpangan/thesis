<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Accounts', function (Blueprint $table) {
            $table->id('AccountID');
            $table->string('Name');
            $table->string('Role');
            $table->string('Username')->unique();
            $table->string('EmailAddress')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('Password');
            $table->RememberToken();
            $table->timestamps();
        });
        // Schema::create('Accounts', function (Blueprint $table) {
        //     $table->id('AccountID');
        //     $table->string('Name');
        //     $table->string('Username')->unique();
        //     $table->string('EmailAddress')->unique();
        //     $table->timestamp('EmailVerifiedAt')->nullable();
        //     $table->string('Password');
        //     $table->RememberToken();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Accounts');
    }
}
