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

        Schema::create('student_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('label', 100);
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
        Schema::dropIfExists('student_types');
    }
};
