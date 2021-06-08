<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->id();

            $table->integer('parent_id')->nullable()->default('0');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('fname', 30)->nullable();  
            $table->string('mname', 30)->nullable();  
            $table->string('lname', 30)->nullable();  
            
            $table->string('email', 100)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->enum('mobileLogin',['1', '0'])->default('1');
            
            $table->string('photo', 150)->nullable();
            
            $table->string('dob', 15)->nullable(); // 2020-01-02
            $table->string('dob_time', 20)->nullable();
            $table->enum('gender', ['m', 'f'])->default('m');
            $table->enum('maritial_status', ['1', '0'])->default('0');

            $table->string('cur_address', 150)->nullable();  
            $table->string('per_address', 150)->nullable();     
           
            $table->string('status', 10)->default('Published');              
            $table->enum('disabled', ['0', '1'])->default('0');           
           
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
        Schema::dropIfExists('member');
    }
}
