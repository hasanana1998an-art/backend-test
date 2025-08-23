<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('address');
            $table->string('status')->default('pending'); // pending, shipped, delivered, canceled
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
