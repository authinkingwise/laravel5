<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description')->nullable();

            $table->integer('status_id')->unsigned()->default(1);
            $table->foreign('status_id')
                    ->references('id')
                    ->on('ticket_statuses');

            $table->integer('account_id')->unsigned()->nullable()->comment('The ticket belongs to this Account.');
            $table->foreign('account_id')
                    ->references('id')
                    ->on('accounts');

            $table->integer('user_id')->unsigned()->nullable()->comment('Assign the ticket to this User.');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users');

            $table->integer('creator_id')->unsigned()->nullable()->comment('The User creates this ticket.');
            $table->foreign('creator_id')
                    ->references('id')
                    ->on('users');

            $table->integer('last_update_user_id')->unsigned()->nullable()->comment('The User who last updated the Ticket, including Comments.');
            $table->foreign('last_update_user_id')
                    ->references('id')
                    ->on('users');

            $table->double('estimated_time')->nullable()->comment('Estimated hours');

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
        Schema::dropIfExists('tickets');
    }
}
