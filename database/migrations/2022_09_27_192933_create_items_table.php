<?php

use App\Models\Category_brand;
use App\Models\Category_product;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            // $table->foreign('kategori_brand_id')->references('id')->on('kategori_brands');
            // $table->foreignId('kategori_brand_id');
            // $table->foreignId('kategori_produk_id');

            $table->foreignId('kategori_brand_id')->constrained('kategori_brands');
            $table->foreignId('kategori_produk_id')->constrained('kategori_produks');

            // $table->foreignIdFor(Category_brand::class)->change('kategori_brand_id');
            // $table->foreignIdFor(Category_product::class)->change('kategori_produk_id');
            $table->integer('qty');
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
        Schema::dropIfExists('items');
    }
};
