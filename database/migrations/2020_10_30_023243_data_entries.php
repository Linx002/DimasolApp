<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dataEntries', function (Blueprint $table) {
            $table->id();
            $table->integer('projects_Id');
            $table->string('entrytype');
            $table->text('entryDescription');
            $table->binary('entryFile');
            $table->date('entryStartDate');
            $table->date('entryEndDate');
            $table->string('sortPos');
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
        Schema::dropIfExists('dataEntries');
    }
}
