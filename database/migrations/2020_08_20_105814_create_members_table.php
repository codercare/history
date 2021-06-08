<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->integer('parent_id')->nullable()->default('0');
            $table->bigInteger('user_id')->unsigned()->nullable(); 
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('fname', 30)->nullable();  
            $table->string('mname', 30)->nullable();  
            $table->string('lname', 30)->nullable();  
            
            $table->string('email', 100)->nullable();
            $table->string('mobile', 20)->nullable();
            $table->string('phone', 20)->nullable();
            $table->boolean('mobileLogin',[true,false])->default(true)->nullable();              
            $table->string('photo', 150)->nullable();            
            $table->string('dob', 15)->nullable(); // 2020-01-02
            $table->string('dob_time', 20)->nullable();
            $table->enum('gender', ['m', 'f'])->default('m')->nullable();  
            $table->enum('maritial_status', ['1', '0'])->default('0')->nullable();  
            $table->string('cur_address', 150)->nullable();  
            $table->string('per_address', 150)->nullable();     
            $table->text('about')->nullable(); 
            $table->enum('relation', ['s','d','w'])->default('s')->nullable(); 
            $table->integer('birth_order')->nullable()->default('0');
            $table->string('status', 10)->default('Published')->nullable();  
            $table->boolean('disabled',[true,false])->default(false)->nullable();               
            $table->softDeletes();
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
        Schema::dropIfExists('members');
    }
}
