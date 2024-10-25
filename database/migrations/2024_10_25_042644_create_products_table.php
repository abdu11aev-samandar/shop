<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();

            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->unsignedBigInteger('cost');
            $table->unsignedBigInteger('retail');

            $table->boolean('active')->default(true);
            $table->boolean('vat')->default(config('shop.vat'));

            $table->foreignId('category_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->foreignId('range_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
