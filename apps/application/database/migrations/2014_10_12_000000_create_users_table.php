<?php

use App\Models\Car;
use App\Models\School;
use App\Models\StudentType;
use App\Models\UserType;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);

            $table->string('email')->index();
            $table->string('tenant_id')->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->json('data')->nullable()->default('[]');

            $table->foreignIdFor(School::class)->nullable();
            $table->foreignIdFor(Car::class)->nullable();
            $table->foreignIdFor(StudentType::class)->nullable();
            $table->foreignIdFor(UserType::class);

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['email', 'tenant_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
