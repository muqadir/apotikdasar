<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockobatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockobats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obat_id');
            $table->integer('masuk'); // Remove length parameter
            $table->integer('keluar'); // Remove length parameter
            $table->decimal('jual', 9, 2);
            $table->decimal('beli', 9, 2);
            $table->date('expired');
            $table->integer('stock'); // Remove length parameter
            $table->string('keterangan', 100)->nullable();
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('obat_id')->references('id')->on('obats')->onDelete('cascade');
            
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
        Schema::dropIfExists('stockobats');
    }
}
