<?php

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
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();

            $table->string('type');

            $table->timestamps();
        });

        array_map(
            array: [
                'central',
                'instructor',
                'student',
                'guest',
                'admin',
            ],

            callback: fn ($type) => UserType::create(compact('type'))
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
};
