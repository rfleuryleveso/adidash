<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_groups', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("year")->comment("The year the class was created. eg: 2020");
            $table->softDeletes(); 
            $table->timestamps();
        });

        DB::table('class_groups')->insert(
            array(
                'name' => 'Pas encore défini.',
                'year' =>  1970
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_groups');
    }
}
