<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text')->comment('Content of the activity');

            $table->integer('comment_id')->unsigned()->comment('The activity is related to a ticket comment.');
            $table->foreign('comment_id')
                ->references('id')
                ->on('ticket_comments');

            $table->integer('user_id')->unsigned()->comment('The activity is created by this User.');
            $table->foreign('user_id')
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
        Schema::dropIfExists('ticket_activities');
    }
}
