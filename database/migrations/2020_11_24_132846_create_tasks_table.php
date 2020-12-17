<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string("name");
            $table->longText("description");
            $table->integer('parent_task')->nullable();
            $table->enum('status', ['WAITING_FOR_PARENT_TASK', 'WAITING', 'STARTED', 'FINISHED', 'CANCELLED']);

            $table->date('ended_at')->nullable();
            $table->date('ends_at')->nullable();

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
        Schema::dropIfExists('tasks');
    }
}
