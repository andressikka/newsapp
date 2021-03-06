<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_articles', function (Blueprint $table) {
            $table->id();
            $table->string('Title');
            $table->longText('Body');
            $table->string('Picture')->nullable();
            $table->boolean('Picture_existance')->nullable()->default(0);
            $table->boolean('Article_hide')->nullable()->default(0);
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
        Schema::dropIfExists('admin_articles');
    }
}
