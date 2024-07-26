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
        $table->bigInteger('user_id')->unsigned();
        $table->string('title');
        $table->text('description')->nullable();
        $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
        $table->date('due_date')->nullable();
        $table->integer('priority')->default(0);
        $table->bigInteger('group_id')->unsigned()->nullable();
        $table->bigInteger('assigned_to')->unsigned()->nullable();
        $table->timestamps();
        $table->softDeletes();
        $table->string('edit')->nullable();

        // 外部キー制約
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('group_id')->references('id')->on('groups')->onDelete('set null');
        $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
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
