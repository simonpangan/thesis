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
        Schema::create('sexTable', function (Blueprint $table) {
            $table->bigIncrements('SexID');
            $table->string('Sex');
            $table->timestamps();
        });
  
        Schema::create('Accounts', function (Blueprint $table) {
            $table->id('AccountID');
            $table->string('Name');
    //        $table->unsignedBigInteger('SexId');
            $table->string('Role');
            $table->string('Username')->unique();
            $table->string('userEmail')->unique();
            $table->timestamp('verifiedAt')->nullable();
            $table->string('Password');
            $table->timestamp('last_seen')->nullable();
            $table->string('remember_key', 100)->nullable();
            $table->timestamp('datetime_created')->nullable();
            $table->timestamp('datetime_updated')->nullable();

         //   $table->foreign('SexId')->references('SexID')->on('sexTable')->onDelete('cascade');

        });
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
