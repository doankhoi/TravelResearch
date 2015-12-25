<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flist', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('serialno')->unique();
            $table->string('name');
            $table->datetime('created_time');
            $table->text('about');
            $table->string('category', 100);
            $table->string('category_list_id', 100);
            $table->string('category_list_name', 100);
            $table->integer('checkins');
            $table->text('company_overview');
            $table->string('cover_cover_id', 100);
            $table->string('cover_offset_x', 10);
            $table->string('cover_offset_y', 10);
            $table->string('cover_source', 200);
            $table->string('cover_id', 100);
            $table->text('description');
            $table->string('founded', 30);
            $table->bigInteger('likes');
            $table->string('location_city', 50);
            $table->string('location_country', 20);
            $table->float('location_latitude');
            $table->float('location_longitude');
            $table->string('location_state', 30);
            $table->string('location_street', 30);
            $table->string('location_zip', 20);
            $table->string('mission', 500);
            $table->string('name2', 200);
            $table->integer('parking_lot');
            $table->integer('parking_street');
            $table->integer('parking_valet');
            $table->string('products', 500);
            $table->bigInteger('talking_about_count');
            $table->string('username', 20);
            $table->string('website', 20);
            $table->bigInteger('were_here_count');
            $table->tinyInteger('delete_flg');
            $table->datetime('created');
            $table->string('creator', 50);
            $table->datetime('modified');
            $table->string('modifier', 50);
            $table->timestamps();
            $table->index(['serialno', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('flist');
    }
}
