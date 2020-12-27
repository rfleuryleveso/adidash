<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->longText("description")->nullable();
            $table->string("intro")->nullable();
            $table->enum("status", ["CREATED", "STARTED", "FINISHED", "FROZEN", "CANCELLED"])->default("CREATED");

            $table->string("drive_link")->nullable();

            // Images
            $table->string("background_image")->nullable();

            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('projects');
    }
}
