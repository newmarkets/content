<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('live_at')->nullable();
            $table->timestamp('down_at')->nullable();
            $table->string('slug');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('author')->nullable();
            $table->string('source_name')->nullable();
            $table->string('source_url')->nullable();
            $table->string('description', 1000)->nullable();
            $table->longText('content');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description', 1000)->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
            $table->string('filename')->nullable();
            $table->string('filename_description')->nullable();
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'fk_article_category1')->references('id')->on('category');
            $table->unique(['category_id', 'slug'], 'un_category_slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article');
    }
}
