<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('destination_rating', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('trip_user_id');
            $table->double('rating');
            $table->string('review');
            $table->timestamps();
        });
        DB::table('destination_rating')->insert(
            array(
                'trip_user_id' => 5,
                'rating' => 4.0,
                'review' => 'Najbolji!',
                'created_at' => now(),
                'updated_at' => now(),
            )
        ); // 1
        DB::table('destination_rating')->insert(
            array(
                'trip_user_id' => 4,
                'rating' => 5.0,
                'review' => 'Najbolja usluga.',
                'created_at' => now(),
                'updated_at' => now(),
            )
        ); // 2
        DB::table('destination_rating')->insert(
            array(
                'trip_user_id' => 3,
                'rating' => 4.0,
                'review' => 'Za putovanja uvijek biram agenciju "Bez Granica".',
                'created_at' => now(),
                'updated_at' => now(),
            )
        ); // 3
        DB::table('destination_rating')->insert(
            array(
                'trip_user_id' => 2,
                'rating' => 5.0,
                'review' => 'Nezaboravno iskustvo putovanja!',
                'created_at' => now(),
                'updated_at' => now(),
            )
        ); // 4
        DB::table('destination_rating')->insert(
            array(
                'trip_user_id' => 1,
                'rating' => 4.0,
                'review' => 'Najbolji!',
                'created_at' => now(),
                'updated_at' => now(),
            )
        ); // 5
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_destination_rating');
    }
};
