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

        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->dateTime('appointment_new_emails')->nullable();
            $table->dateTime('appointment_update_emails')->nullable();
            $table->dateTime('appointment_cancel_emails')->nullable();
            $table->unsignedBigInteger('notification_preferenceable_id');
            $table->string('notification_preferenceable_type');
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
        Schema::dropIfExists('notification_preferences');
    }
};
