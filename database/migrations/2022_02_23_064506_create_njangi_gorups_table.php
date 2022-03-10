<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNjangiGorupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('njangi_gorups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('creator_id');
            $table->string('group_name',255);
            $table->text('group_image');
            $table->double('contribution_amount',255,2);
            $table->enum('contribution_level',['Quarterly','Weekly','Monthly','Yearly'])->default('Weekly');
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
        Schema::dropIfExists('njangi_gorups');
    }
}
