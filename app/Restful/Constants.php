<?php
namespace App\Restful;

/**
* All variable for Restful
*/
class Constants
{
    /* API for facebook */
    const PERMISSION_USERS = [
        'email',
        'user_likes'
    ];
    const FIELDS_API_FANPAGE_INFOMATION_FACEBOOK = "?fields=id,about,category,checkins,company_overview,cover,description,founded,likes,link,location,mission,name,parking,products,talking_about_count,username,website,were_here_count";
    const API_LIST_FANPAGE_LIKES = "/me/likes";
    const API_BASIC_INFO_FACEBOOK = "me?fields=id,name";
}