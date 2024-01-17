<?php namespace Fiiliip\EMarketplace\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateListingsTable extends Migration {
    public function up() {
        Schema::create('fiiliip_emarketplace_listings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->string('title');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('location');
            $table->integer('views')->default(0);

            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('fiiliip_emarketplace_listings');
    }
}

?>