<?php namespace Fiiliip\EMarketplace\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateListingsTable extends Migration {
    public function up() {
        Schema::create('fiiliip_emarketplace_listings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('title');
            $table->integer('category_id')->unsigned();

            $table->integer('user_id')->unsigned();

            $table->decimal('price', 10, 2);
            $table->integer('location_id')->unsigned();
            $table->integer('views')->default(0);

            $table->text('description')->nullable();

            $table->timestamps();    
        });
    }

    public function drop() {
        Schema::dropIfExists('fiiliip_emarketplace_listings');
    }
}

?>