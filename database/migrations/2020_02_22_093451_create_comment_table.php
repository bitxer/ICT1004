<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
            $table->increments('uuid')->unsigned();
            $table->string('comment', 200);
            $table->integer('usr_uuid')->unsigned();
            $table->integer('post_uuid')->unsigned();
            $table->foreign('post_uuid')
                  ->references('uuid')
                  ->on('post')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->foreign('usr_uuid')
                  ->references('uuid')
                  ->on('user')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
