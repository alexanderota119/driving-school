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
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('dropdowns', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('type_name', 50);
            $table->integer('sort')->nullable();
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('dropdowns');
    }
};
