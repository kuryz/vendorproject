<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('serial_number');
            $table->string('description');
            $table->enum('motion',['fixed','movable']);
            $table->string('picture_path');
            $table->string('purchase_date');
            $table->string('start_use_date');
            $table->string('purchase_price');
            $table->string('warranty_expiry_date');
            $table->string('degradation');
            $table->string('current_value');
            $table->string('location');
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
        Schema::dropIfExists('assets');
    }
}
