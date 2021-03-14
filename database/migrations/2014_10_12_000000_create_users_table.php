<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable(); 
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('username')->nullable();
            $table->string('address')->nullable(); 
            $table->string('city')->nullable(); 
            $table->string('state')->nullable(); 
            $table->string('zip_code')->nullable(); 
            $table->string('phone')->nullable(); 
            $table->enum('type', ['user', 'adjuster'])->nullable();
            $table->integer('is_active')->comment('1 active, 0 inactive')->nullable();
            $table->integer('is_approved_by_admin')->comment('1 approved, 0 not approved')->nullable();
            $table->integer('is_blocked')->comment('1 blocked, 0 not blocked')->nullable();
            $table->string('forgot_token')->nullable();
            $table->string('email_confirmaiton_token')->nullable();
            $table->string('email_token')->nullable(); 
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
