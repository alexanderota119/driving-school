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

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('id')->on('tenants');
            $table->foreignId('student_id')->constrained('users', 'id');
            $table->foreignId('instructor_id')->constrained('users', 'id');
            $table->foreignId('creator_id')->constrained('users');
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->foreignId('appointment_type_id')->constrained();
            $table->foreignId('test_location_id')->constrained()->nullable();
            $table->dateTime('test_passed')->nullable();
            $table->dateTime('cancelled_date')->nullable();
            $table->string('cancelled_comment', 200);
            $table->foreignId('car_id')->constrained();
            $table->foreignId('pickup_location_id')->constrained('test_locations')->nullable();
            $table->string('dl304a', 10)->nullable()->default('');
            $table->string('dl304c', 10)->nullable()->default('');
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
        Schema::dropIfExists('appointments');
    }
};
