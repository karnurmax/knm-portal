<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluginCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugin_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plugin_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->text('plugin_comment');
            $table->foreign('plugin_id')
                    ->references('id')->on('plugins')
                    ->onDelete('cascade');
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('plugin_comments');
    }
}
