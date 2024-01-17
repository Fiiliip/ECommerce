<?php 
namespace WUserApi\UserApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use RainLab\User\Models\User;

class addDegreeToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->string('degree')->nullable();
        });
    }

    public function down()
    {
        
    }
}
