<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('sortorder')->nullable();
            $table->string('root')->nullable();
            $table->string('path');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
            $table->unique(['root', 'path'], 'un_root_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category');
    }
}
