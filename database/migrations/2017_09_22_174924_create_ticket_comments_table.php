<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();

            $table->integer('ticket_id')->unsigned()->comment('The comment is linked to this Ticket.');
            $table->foreign('ticket_id')
                ->references('id')
                ->on('tickets')
                ->onDelete('cascade');

            $table->integer('user_id')->unsigned()->comment('The comment is created by this User.');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->double('time')->nullable()->comment('Hours spent on the ticket.');

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
        Schema::dropIfExists('ticket_comments');
    }
}
