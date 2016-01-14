<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SammyK\LaravelFacebookSdk\SyncableGraphNodeTrait;

class FList extends Model
{
	use SyncableGraphNodeTrait;
    protected $table = 'flist';
    protected $fillable = [
        'serialno',
        'about',
        'created_time',
        'category',
        'category_list_id',
        'category_list_name',
        'company_overview',
        'cover_cover_id',
        'cover_offset_x',
        'cover_offset_y',
        'cover_source',
        'cover_id',
        'description',
        'founded',
        'likes',
        'location_city',
        'location_country',
        'location_latitude',
        'location_longitude',
        'location_state',
        'location_street',
        'location_zip',
        'mission',
        'name2',
        'links',
        'parking_lot',
        'parking_street',
        'parking_valet',
        'products',
        'talking_about_count',
        'username',
        'website',
        'were_here_count'
    ];

    protected static $graph_node_field_aliases = [
        'id' => 'serialno',
        'about' => 'about',
        'created_time' => 'created_time',
        'category' => 'category',
        // 'category_list.0.id' => 'category_list_id',
        // 'category_list.0.name' => 'category_list_name',
        'company_overview' => 'company_overview',
        'cover.cover_id' => 'cover_cover_id',
        'cover.offset_x' => 'cover_offset_x',
        'cover.offset_y' => 'cover_offset_y',
        'cover.source' => 'cover_source',
        'cover.id' => 'cover_id',
        'description' => 'description',
        'founded' => 'founded',
        'likes' => 'likes',
        'link' => 'links',
        'location.city' => 'location_city',
        'location.country' => 'location_country',
        'location.latitude' => 'location_latitude',
        'location.longitude' => 'location_longitude',
        'location.state' => 'location_state',
        'location.street' => 'location_street',
        'location.zip' => 'location_zip',
        'mission' => 'mission',
        'name' => 'name2',
        'parking.lot' => 'parking_lot',
        'parking.street' => 'parking_street',
        'parking.valet' => 'parking_valet',
        'products' => 'products',
        'talking_about_count' => 'talking_about_count',
        'username' => 'username',
        'website' => 'website',
        'were_here_count' => 'were_here_count'
    ];
}
