<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    public function up()
//    {
//        Schema::create('books', function (Blueprint $table) {
//            $table->id();
//            $table->string('title');
//            $table->string('author');
//            $table->timestamps();
//        });
//    }
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('genre')->nullable();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
//    public function down()
//    {
//        Schema::dropIfExists('books');
//    }
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['genre', 'description']);
        });
    }
}
