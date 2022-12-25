<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('e_id'); // EXTERNAL ID
            $table->string('title');
            $table->text('description');
            $table->string('poster')->nullable();
            $table->string('banner')->nullable();
            $table->enum('type', ['upcoming', 'now_playing'])->nullable();
            $table->date('release_date');
            $table->double('vote', 8, 2);
            $table->bigInteger('vote_count');
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
        Schema::dropIfExists('movies');
    }
};
