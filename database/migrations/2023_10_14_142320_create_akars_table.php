<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkarsTable extends Migration
{
    public function up()
    {
        Schema::create('akars', function (Blueprint $table) {
            $table->id();
            $table->double('input_number');
            $table->double('square_root')->nullable();
            $table->string('method');
            $table->double('execution_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('akars');
    }
}
