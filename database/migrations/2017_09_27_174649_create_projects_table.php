<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();

            $table->integer('account_id')->unsigned()->nullable();
            $table->foreign('account_id')
                    ->references('id')
                    ->on('accounts');

            $table->integer('user_id')->unsigned()->nullable()->comment('The project is assigned to this User.');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->integer('creator_id')->unsigned()->comment('The project is created by this User.');
            $table->foreign('creator_id')
                    ->references('id')
                    ->on('users');

            $table->boolean('status')->default(1)->comment('If the project is active or inactive.');

            $table->boolean('visible')->default(1)->comment('Visible to every user or not.');

            $table->text('allowed_users')->nullable()->comment('These users are allowed to view the project if the project is not visible to everyone.');

            $table->integer('last_update_user_id')->unsigned()->nullable()->comment('The User who last updated the Project.');
            $table->foreign('last_update_user_id')
                    ->references('id')
                    ->on('users');

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
        Schema::dropIfExists('projects');
    }
}
