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
            $table->foreign('category_id')->references('id')->on('fiiliip_emarketplace_categories')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2); // 10 digits in total, 2 after the decimal point
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