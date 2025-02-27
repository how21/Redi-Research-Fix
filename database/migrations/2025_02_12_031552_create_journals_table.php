<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('authors');
            $table->integer('publication_year');
            $table->string('publisher')->nullable();
            $table->text('abstract')->nullable();
            $table->string('file_path')->nullable(); 
            $table->string('doi')->nullable();
            $table->json('keyword')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('journals');
    }
};
