<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id');
            $table->string('group_name',255);
            $table->text('group_image');
            $table->float('contribution_amount');
            $table->enum('contributional_interval',['quaterly','weekly','monthly','yearly'])->default('weekly');
            $table->enum('status',['active','inactive'])->default('active');

            $table->timestamps();
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('investment_groups');
    }
}
