<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles');
            $table->string('name');
            $table->string('slug');
            $table->string('email')->unique();
            // $table->string('designation')->nullable();
            // $table->string('department')->nullable();
            // $table->string('semester')->nullable();
            // $table->string('student_id')->nullable();
            $table->string('phone')->nullable();
            // $table->string('address')->nullable();
            $table->string('image')->default('default_user.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_modifiable')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
