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
        Schema::create('trip_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('trip_id');
            $table->bigInteger('user_id');
            $table->integer('spots');
            $table->string('reservation_data', 2048);
            $table->timestamps();
        });
        DB::table('trip_user')->insert(
            array(
                'trip_id' => 1,
                'user_id' => 3,
                'spots' => 1,
                'reservation_data' => '[{"full_name":"Jelena Begic","birth_date":"2000-09-30"}]',
            )
        ); // 1
        DB::table('trip_user')->insert(
            array(
                'trip_id' => 1,
                'user_id' => 4,
                'spots' => 1,
                'reservation_data' => '[{"full_name":"Albert Dera","birth_date":"2000-09-30"}]',
            )
        ); // 2
        DB::table('trip_user')->insert(
            array(
                'trip_id' => 1,
                'user_id' => 5,
                'spots' => 1,
                'reservation_data' => '[{"full_name":"Marija Kovačević","birth_date":"2000-09-30"}]',
            )
        ); // 3
        DB::table('trip_user')->insert(
            array(
                'trip_id' => 1,
                'user_id' => 6,
                'spots' => 1,
                'reservation_data' => '[{"full_name":"Barbara Petrović","birth_date":"2000-09-30"}]',
            )
        ); // 4
        DB::table('trip_user')->insert(
            array(
                'trip_id' => 1,
                'user_id' => 7,
                'spots' => 1,
                'reservation_data' => '[{"full_name":"Antonio Horvat","birth_date":"2000-09-30"}]',
            )
        ); // 5
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_trip_user');
    }
};
