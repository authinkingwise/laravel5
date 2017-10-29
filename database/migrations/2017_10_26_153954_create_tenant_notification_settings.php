<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantNotificationSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_notification_settings', function (Blueprint $table) {
            $table->uuid('id');
            $table->boolean('ticket_update')->nullable()->comment('Notifies the user when the ticket is updated.');
            $table->boolean('project_update')->nullable()->comment('Notifies the user when the project is updated.');
            $table->boolean('role_update')->nullable()->comment('Notifies the user when the role (permission) is updated.');
            $table->boolean('news_update')->nullable()->comment('Email the user when we have news.');
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
        Schema::dropIfExists('tenant_notification_settings');
    }
}
