<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->string('nota', 15)->primary(); 
            $table->decimal('totalharga', 10, 2);  
            $table->decimal('totaldiskon', 10, 2);  
            $table->decimal('totalpajak', 10, 2);  
            $table->decimal('harusbayar', 10, 2);
            $table->decimal('jumlahdibayar', 10, 2);
            $table->decimal('kembali', 10, 2);
            $table->enum('status', ['Cash', 'Hutang']);
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
        Schema::dropIfExists('pembayarans');
    }
}
