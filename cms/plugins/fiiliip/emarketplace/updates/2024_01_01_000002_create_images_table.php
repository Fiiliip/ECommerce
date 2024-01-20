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
            $table->foreign('listing_id')->references('id')->on('fiiliip_emarketplace_listings')->onUpdate('cascade')->onDelete('cascade');

            $table->string('image_path')->unique();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fiiliip_emarketplace_images');

        // TODO: Remove the images from the storage.
        $storagePath = storage_path('app/uploads/public');
        if (file_exists($storagePath)) {
            $files = glob($storagePath . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
    }
}