<?php

use App\Models\User;
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
        Schema::create('user_login_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);
            $table->boolean('was_successful')->nullable()->default(true);
            $table->json('meta')->nullable()->default('[]');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_login_histories');
    }
};
