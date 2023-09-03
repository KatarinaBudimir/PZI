<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('role')->default('user');
            $table->string('password');
            $table->string('avatar_url')->default('slike/no-profile-picture-icon.webp');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            array(
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
            )
        ); // 1
        DB::table('users')->insert(
            array(
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => Hash::make('user'),
                'role' => 'user',
            )
        ); // 2
        DB::table('users')->insert(
            array(
                'name' => 'Jelena Begic',
                'email' => 'jelena@user.com',
                'password' => Hash::make('user'),
                'avatar_url' => 'slike/christopher-campbell-rDEOVtE7vOs-unsplash.jpg',
                'role' => 'user',
            )
        ); // 3
        DB::table('users')->insert(
            array(
                'name' => 'Albert Dera',
                'email' => 'albert@user.com',
                'password' => Hash::make('user'),
                'avatar_url' => 'slike/albert-dera-ILip77SbmOE-unsplash.jpg',
                'role' => 'user',
            )
        ); // 4
        DB::table('users')->insert(
            array(
                'name' => 'Marija Kovačević',
                'email' => 'marija@user.com',
                'password' => Hash::make('user'),
                'avatar_url' => 'slike/edward-cisneros-_H6wpor9mjs-unsplash.jpg',
                'role' => 'user',
            )
        ); // 5
        DB::table('users')->insert(
            array(
                'name' => 'Barbara Petrović',
                'email' => 'barbara@user.com',
                'password' => Hash::make('user'),
                'avatar_url' => 'slike/brooke-cagle-YnjmBvkYFgc-unsplash.jpg',
                'role' => 'user',
            )
        ); // 6
        DB::table('users')->insert(
            array(
                'name' => 'Antonio Horvat',
                'email' => 'antonio@user.com',
                'password' => Hash::make('user'),
                'avatar_url' => 'slike/ana-nichita-BI91NrppE38-unsplash.jpg',
                'role' => 'user',
            )
        ); // 7
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
