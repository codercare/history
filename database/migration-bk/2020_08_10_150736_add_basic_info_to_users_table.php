<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBasicInfoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('fname', 100)->nullable();  
            $table->string('mname', 100)->nullable();  
            $table->string('lname', 100)->nullable();  
            $table->string('mobile', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('current_address', 200)->nullable();       
            $table->string('dob', 100)->nullable();
            $table->string('dob_time', 100)->nullable();
            $table->string('photo', 200)->nullable();
            $table->enum('gender', ['m', 'f'])->default('m');
            $table->enum('maritial_status', ['1', '0'])->default('0');
            $table->string('citizenship_no', 100)->nullable();
            $table->string('citizenship_file', 200)->nullable();
            $table->string('passport_no', 100)->nullable();
            $table->string('passport_file', 200)->nullable();
            $table->string('status', 100)->default('Published');  // 1 for Active User 2 for- deactive 3 for new 
            $table->enum('disabled', ['0', '1'])->default('0');
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
