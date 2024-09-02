<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('faktur', 15);
            $table->date('tanggal');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('user_id');
            // $table->string('kode', 8);
            $table->integer('item');
            $table->decimal('harga', 9, 2);
            $table->integer('qty');
            $table->decimal('totalkotor', 9, 2); // Ganti dari 'subtotal'
            $table->decimal('pajak', 9, 2);
            $table->decimal('diskon', 9, 2);
            $table->decimal('totalbersih', 9, 2); // Tambahkan kolom baru
            $table->string('keterangan', 150);
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   
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
        Schema::dropIfExists('pembelians');
    }
}
