<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.clear
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('recipies', 'recipes');
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name", 200); 
            $table->foreignId("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');           
            $table->integer('timeToMake');
            $table->integer('serves');
            $table->foreignId("category_id");
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); 
            $table->integer('raiting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipies');
    }
}
