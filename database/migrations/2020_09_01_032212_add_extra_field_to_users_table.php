<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile', 20)->nullable()->after('remember_token');
            $table->string('username',30)->nullable()->after('mobile'); 
            $table->string('photo', 150)->nullable()->after('username');            
            $table->boolean('status',[true,false])->default(true)->after('photo'); 
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
            $table->dropColumn('mobile');
            $table->dropColumn('username');
            $table->dropColumn('photo');
            $table->dropColumn('status');
        });
    }
}
