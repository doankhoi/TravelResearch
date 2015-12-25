<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTlist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tlist', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('serialno')->unique();
            $table->string('t_id', 20);
            $table->string('t_id_str', 20);
            $table->string('name', 50);
            $table->string('screen_name', 50);
            $table->string('location', 100);
            $table->string('profile_location');
            $table->text('description');
            $table->string('url', 200);
            $table->string('entities_url_url', 200);
            $table->string('entities_url_expanded_url', 200);
            $table->string('entities_url_display_url', 200);
            $table->string('entities_description_url', 200);
            $table->string('entities_description_expanded_url', 200);
            $table->string('entities_description_display_url', 200);
            $table->integer('followers_count');
            $table->integer('friends_count');
            $table->integer('listed_count');
            $table->datetime('created_at_t');
            $table->integer('favourites_count');
            $table->string('utc_offset', 200);
            $table->string('time_zone', 30);
            $table->string('geo_enabled', 50);
            $table->string('verified', 50);
            $table->integer('statuses_count');
            $table->string('lang', 10);
            $table->datetime('status_created_at');
            $table->bigInteger('status_id');
            $table->bigInteger('status_id_str');
            $table->text('status_text');
            $table->text('status_source');
            $table->integer('status_retweet_count');
            $table->integer('status_favorite_count');
            $table->string('status_entities', 50);
            $table->string('profile_background_color', 30);
            $table->string('profile_background_image_url', 200);
            $table->string('profile_background_image_url_https', 200);
            $table->string('profile_image_url', 200);
            $table->string('profile_image_url_https', 200);
            $table->string('profile_banner_url', 200);
            $table->string('profile_link_color', 100);
            $table->string('profile_sidebar_border_color', 100);
            $table->string('profile_sidebar_fill_color', 100);
            $table->string('profile_text_color', 100);
            $table->string('profile_use_background_image', 100);
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
        Schema::drop('tlist');
    }
}
