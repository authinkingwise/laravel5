<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plannings', function (Blueprint $table) {
            $table->uuid('id');

            $table->integer('user_id')->unsigned()->comment('The user for this planning');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->integer('creator_id')->unsigned()->comment('The user who creates the planning');
            $table->foreign('creator_id')
                    ->references('id')
                    ->on('users');

            $table->integer('ticket_id')->unsigned()->nullable()->comment('The ticket for this planning');
            $table->foreign('ticket_id')
                    ->references('id')
                    ->on('tickets');

            $table->integer('project_id')->unsigned()->nullable()->comment('The project for this planning');
            $table->foreign('project_id')
                    ->references('id')
                    ->on('projects');

            $table->integer('task_id')->unsigned()->nullable()->comment('The task for this planning');
            $table->foreign('task_id')
                    ->references('id')
                    ->on('tasks');

            $table->text('description')->nullable();

            $table->double('schedule_hours')->nullable()->comment('Schedule hours for the planning');

            $table->date('schedule_date')->nullable();

            $table->double('actual_hours')->nullable()->comment('Actual working hours for the planning');

            $table->date('actual_date')->nullable()->comment('Actual working date after user updates the planning');

            $table->integer('tenant_id')->unsigned()->comment('Foreign key to table tenants');
            $table->foreign('tenant_id')
                    ->references('id')
                    ->on('tenants');

            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plannings');
    }
}
