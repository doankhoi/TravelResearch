<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TList extends Model
{
    protected $table = 'tlist';
    protected $fillable = [
    	'serialno',
        't_id',
        't_id_str',
        'name',
        'screen_name',
        'location',
        'profile_location',
        'description',
        'url',
        'entities_url_url',
        'entities_url_expanded_url',
        'entities_url_display_url',
        'entities_description_url',
        'entities_description_expanded_url',
        'entities_description_display_url',
        'followers_count',
        'friends_count',
        'listed_count',
        'created_at_t',
        'favourites_count',
        'utc_offset',
        'time_zone',
        'geo_enabled',
        'verified',
        'statuses_count',
        'lang',
        'status_created_at',
        'status_id',
        'status_id_str',
        'status_text',
        'status_source',
        'status_retweet_count',
        'status_favorite_count',
        'status_entities',
        'profile_background_color',
        'profile_background_image_url',
        'profile_background_image_url_https',
        'profile_image_url',
        'profile_image_url_https',
        'profile_banner_url',
        'profile_link_color',
        'profile_sidebar_border_color',
        'profile_sidebar_fill_color',
        'profile_text_color',
        'profile_use_background_image',
        'delete_flg',
        'created',
        'creator',
        'modifier'
    ];
}
