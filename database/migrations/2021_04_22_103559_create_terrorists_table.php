<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerroristsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terrorists', function (Blueprint $table) {
            $table->id();
            $table->integer("status_id");
            $table->integer("post_type")->default(0);
            $table->string("fio");
            $table->string("date_birth")->nullable();
            $table->string("date_add")->nullable();
            $table->string("document_type")->nullable();
            $table->string("document_number")->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('terrorists');
    }
}
