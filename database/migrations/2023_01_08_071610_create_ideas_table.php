<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdeasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ideas_categories_id');
            $table->foreign('ideas_categories_id')
                ->references('id')
                ->on('ideas_categories')
                ->onDelete("cascade");
            $table->string('author');
            $table->string('title');
            $table->char('status', 50);
            $table->text('description');
            $table->integer('likes');
            $table->timestamp('created_at')->useCurrent();
            $table->string('file');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ideas');
    }
}
