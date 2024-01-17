<?php 
namespace WUserApi\UserApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use RainLab\User\Models\User;

class addPhoneNumberToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function($table)
        {
            $table->engine = 'InnoDB';
            $table->boolean('is_phone_number_verified')->nullable()->default(false);
            $table->string('phone_number')->nullable()->unique();
        });
    }

    public function down()
    {
        
    }
}
