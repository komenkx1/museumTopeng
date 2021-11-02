<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_guest")->constrained("guests","id");
            $table->foreignId("id_package")->constrained("packages","id");
            $table->string("session_ID")->nullable();
            $table->string("url")->nullable();
            $table->string("trx_id")->nullable();
            $table->string("paid_at")->nullable();;   
            $table->string("status");   
            $table->string("payment_method");   
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
        Schema::dropIfExists('transactions');
    }
}
