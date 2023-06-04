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

        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street1', 100);
            $table->string('street2', 100)->nullable();
            $table->string('street3', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->foreignId('state_id')->constrained()->nullable();
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->string('zipcode', 25);
            $table->unsignedBigInteger('addressable_id');
            $table->string('addressable_type');
            $table->string('confirmed_on_service')->nullable();
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
        Schema::dropIfExists('addresses');
    }
};
