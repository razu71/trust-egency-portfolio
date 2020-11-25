<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeafletPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaflet_pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('leaflet_id')->unsgined();
            $table->integer('page_no');
            $table->text('page_content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaflet_pages');
    }
}
