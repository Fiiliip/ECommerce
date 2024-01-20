<?php namespace Fiiliip\EMarketplace\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateCategoriesTable extends Migration {
    public function up() {
        Schema::create('fiiliip_emarketplace_categories', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('slug')->unique();
        });
    }

    public function down() {
        Schema::dropIfExists('fiiliip_emarketplace_categories');
    }
}