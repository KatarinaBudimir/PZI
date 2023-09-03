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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 2048);
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->double('price');
            $table->double('rating')->default(5.0);
            $table->string('image_url');
            $table->timestamps();
        });
        DB::table('destinations')->insert(
            array(
                'name' => 'Madrid',
                'description' => 'Madrid je jedan od onih gradova u kojima se naglašeno sudaraju tradicionalno i moderno. Hodajući po njegovim ulicama primjetiti ćete kako se često izmjenjuju povijesne znamenitosti i poslovnezgrade. To ćete lako doživjeti ako prijeđete put od Plata de Espana do Plaza de Cibeles.',
                'latitude' => '40.4168',
                'longitude' => '3.7038',
                'price' => '671.00',
                'rating' => '5.0',
                'image_url' => 'slike/MADRID.jpg',
            ));
        DB::table('destinations')->insert(
            array(
                'name' => 'Moskva',
                'description' => 'Glavni i najveći grad Rusije, na obalama rijeke Moskve po kojoj je i dobio ime. Ukupno 49 mostova na gradskom teritoriju povezuje dvije obale ove rijeke. Moskva nosi epitet najzelenije prijestolnice na svjetu. U Moskvi ćete sigurno vidjeti nešto što će Vas oduševiti.',
                'latitude' => '55.7558',
                'longitude' => '37.6173',
                'price' => '580.00',
                'rating' => '4.0',
                'image_url' => 'slike/Moskva-ICT-Putovanja.jpg',
            ));
        DB::table('destinations')->insert(
            array(
                'name' => 'London',
                'description' => 'Kao jedna od vodećih turističkih destinacija, London privlači više od 15 milijuna posjetitelja svake godine. Glavni grad Velike Britanije je ujedno i središte kulture, umjetnosti i glazbe. London je veličanstveno mjesto prepun nevjerovatnih atrakcija.',
                'latitude' => '51.5072',
                'longitude' => '0.1276',
                'price' => '445.00',
                'rating' => '4.0',
                'image_url' => 'slike/tower-bridge-london-uk-38138737.jpg',
            ));
        DB::table('destinations')->insert(
            array(
                'name' => 'Cappadocia',
                'description' => 'Cappadocia je čarobna regija vrtloga vulkanskog kamenja. Cijela pokrajina prepuna je građevina ukledanih u stijene u kojima su ljudi prije živjeli. Jedan od zaštitnih znakova Cappadocije je svakako vožnja balonom. Dođite i doživite nezaboravno iskustvo.',
                'latitude' => '38.6587',
                'longitude' => '34.8532',
                'price' => '690.00',
                'rating' => '4.9',
                'image_url' => 'slike/cappadocia-turkey-travel-guide.jpg',
            ));
        DB::table('destinations')->insert(
            array(
                'name' => 'Dubai',
                'description' => 'Dubai-grad raskoši,zlata i dijamanata. Jedan dan u gradu budućnosti pamti se cijeli život. Umjetni otoci, najviša zgradana svijetu i skijanje ured pustinje zovu u Dubai, no prijeputa,osim vize,važno je upamtiti da vrijede drugačija pravila odjevanja.',
                'latitude' => '25.2048',
                'longitude' => '55.2708',
                'price' => '920.00',
                'rating' => '4.75',
                'image_url' => 'slike/preuzmi%20(1).jpg',
            ));
        DB::table('destinations')->insert(
            array(
                'name' => 'Havana',
                'description' => 'Najveći grad,najveća luka i vodeći trgovački centar Kube, jedan od najlješih karipskih gradova. Havana privlači ljubitelje uzbuđenja iz cijeloga svijeta. Noću grad ne spava,ulice su pune hodanja. Glazba se ne zaustavlja, a kubanski rum teče poput rijeke.',
                'latitude' => '25.2048',
                'longitude' => '55.2708',
                'price' => '1425.00',
                'rating' => '4.95',
                'image_url' => 'slike/preuzmi.jpg',
            ));
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};
