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

        Schema::create('time_offs', function (Blueprint $table) {
            $table->id();
            $table->date('date_time_off');
            $table->time('time_start');
            $table->time('time_end');
            $table->foreignIdFor(App\Models\User::class)->nullable();
            $table->foreignIdFor(App\Models\Instructor::class)->nullable();
            $table->string('recur_token', 50)->nullable();
            $table->string('comments', 200)->nullable();
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
        Schema::dropIfExists('time_offs');
    }
};
