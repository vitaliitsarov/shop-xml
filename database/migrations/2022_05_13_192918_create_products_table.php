<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(true);
            $table->string('original_url')->nullable(true);
            $table->mediumText('description')->nullable(true);
            $table->integer('id_provider')->unique();
            $table->decimal('price_netto', 18, 2)->default(0);
            $table->decimal('price_brutto', 18, 2)->default(0);
            $table->integer('vat')->default(0);
            $table->integer('stock')->default(0);
            $table->boolean('status')->default(false);
            $table->string('barcode')->nullable(true);
            $table->json('images')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
