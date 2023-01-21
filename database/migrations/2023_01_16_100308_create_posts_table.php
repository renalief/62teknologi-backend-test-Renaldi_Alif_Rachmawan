<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->string('location')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->string('term')->nullable();
            $table->integer('radius')->nullable();
            $table->string('categories')->nullable();
            $table->integer('locale')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('open_now')->nullable();
            $table->integer('open_at')->nullable();
            $table->string('attributes')->nullable();
            $table->enum('sort_by',  array('best_match', 'rating', 'review_count', 'distance'))->nullable();
            $table->enum('device_platform', array('android', 'ios', 'mobile_generic'))->nullable();
            $table->string('reservation_date')->nullable();
            $table->string('reservation_time')->nullable();
            $table->integer('reservation_covers')->nullable();
            $table->boolean('matches_party_size_param')->nullable();
            $table->integer('limit')->nullable();
            $table->integer('offset')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
