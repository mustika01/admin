<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // $table->foreignId('user_id')->constrained();
            $table->foreignId('position_id')->constrained('positions');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('coach_id')
            ->nullable()
            ->constrained('employees');
            $table->foreignId('manager_id')
            ->nullable()
            ->constrained('employees');

            $table->string('name');
            $table->string('email');
            $table->string('tag');
            $table->string('mobile')
            ->nullable();
            $table->string('phone')
            ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('departments');

    }
};
