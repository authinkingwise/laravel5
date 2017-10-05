<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();

            $table->integer('project_id')->unsigned()->nullable()->comment('The task belongs to this Project');
            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects')
                    ->onDelete('cascade');

            $table->integer('user_id')->unsigned()->nullable()->comment('The task is assigned to this User.');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->integer('creator_id')->unsigned()->comment('The task is created by this User.');
            $table->foreign('creator_id')
                    ->references('id')
                    ->on('users');

            $table->integer('last_update_user_id')->unsigned()->nullable()->comment('The User who last updated the Task.');
            $table->foreign('last_update_user_id')
                    ->references('id')
                    ->on('users');
            
            $table->integer('schedule_id')->unsigned()->default(1)->comment('The Schedule status for the task.');
            $table->foreign('schedule_id')
                    ->references('id')
                    ->on('task_schedules');

            $table->dateTime('due_date_time')->nullable();

            $table->integer('order_index')->unsigned()->nullable()->comment('The task order in the same schedule');

            $table->integer('tenant_id')->unsigned()->nullable()->comment('Foreign key to table tenants');
            $table->foreign('tenant_id')
                    ->references('id')
                    ->on('tenants');

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
