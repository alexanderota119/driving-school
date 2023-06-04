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

        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_primary')->nullable()->default(false);
            $table->dateTime('can_receive_sms')->nullable()->comment('If not null can receive sms');
            $table->string('number', 50);
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->unsignedBigInteger('phoneable_id');
            $table->string('phoneable_type');
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
        Schema::dropIfExists('phones');
    }
};
