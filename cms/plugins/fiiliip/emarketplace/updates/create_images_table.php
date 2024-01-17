<?php namespace Fiiliip\EMarketplace\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('fiiliip_emarketplace_images', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('listing_id')->unsigned();
            $table->string('image_path');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fiiliip_emarketplace_images');
    }
}