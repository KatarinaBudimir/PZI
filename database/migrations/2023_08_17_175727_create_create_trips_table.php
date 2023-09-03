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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('destination_id');
            $table->string('date_start');
            $table->string('date_end');
            $table->integer('spots');
            $table->double('discounted_price');
            $table->timestamps();
        });
        DB::table('trips')->insert(
            array(
                'destination_id' => '1',
                'date_start' => '01-08-2023',
                'date_end' => '08-08-2023',
                'spots' => '15',
                'discounted_price' => '661.00',
            ));
        DB::table('trips')->insert(
            array(
                'destination_id' => '2',
                'date_start' => '01-08-2023',
                'date_end' => '08-08-2023',
                'spots' => '16',
                'discounted_price' => '661.00',
            ));
        DB::table('trips')->insert(
            array(
                'destination_id' => '3',
                'date_start' => '01-08-2023',
                'date_end' => '08-08-2023',
                'spots' => '25',
                'discounted_price' => '661.00',
            ));
        DB::table('trips')->insert(
            array(
                'destination_id' => '3',
                'date_start' => '11-08-2023',
                'date_end' => '18-08-2023',
                'spots' => '5',
                'discounted_price' => '661.00',
            ));
        DB::table('trips')->insert(
            array(
                'destination_id' => '4',
                'date_start' => '01-08-2023',
                'date_end' => '08-08-2023',
                'spots' => '5',
                'discounted_price' => '661.00',
            ));
        DB::table('trips')->insert(
            array(
                'destination_id' => '5',
                'date_start' => '01-08-2023',
                'date_end' => '08-08-2023',
                'spots' => '5',
                'discounted_price' => '661.00',
            ));
        DB::table('trips')->insert(
            array(
                'destination_id' => '3',
                'date_start' => '01-10-2023',
                'date_end' => '08-10-2023',
                'spots' => '30',
                'discounted_price' => '461.00',
            ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_trips');
    }
};
