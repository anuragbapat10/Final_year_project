<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('desc_comment_id');
            $table->unsignedBigInteger('assignee_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('desc_comment_id')->references('id')->on('comments')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('assignee_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('status_id')->references('id')->on('statuses')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
};

// TODO: models of all migrations
// TODO: seeders for all tables
// TODO: handle invalid input requests in getUser