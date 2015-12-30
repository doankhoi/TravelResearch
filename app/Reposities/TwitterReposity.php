<?php

namespace App\Reposities;
use App\Models\TList;
use Twitter;

class TwitterReposity
{

    /**
     * Update info a twitter with screen_name
     * @param  string $screen_name Screen name of acount twitter
     * @throws Exception
     * @return void
     */
    public function storeOrUpdateScreenName($screen_name)
    {
        try {
            $twitter = TList::where('screen_name', $screen_name)->first();
            $arrInfo = Twitter::getUsers(['screen_name' => $screen_name, 'format' => 'array']);
            $arrConv = $this->__convertToArrayTwitter($arrInfo);
            $twitter->fill($arrConv);
            $twitter->save();
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }

    /**
     * Update list twitter
     * @throws Exception
     * @return void
     */
    public function updatedListTwitter()
    {
        try {
            $listTwitter = TList::all();
            foreach ($listTwitter as $item) {
                $this->storeOrUpdateScreenName($item->screen_name);
            }
        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
    }

    private function __convertToArrayTwitter($rawArr)
    {
        $result = [];
        $result['t_id'] = $rawArr['id'];
        $result['t_id_str'] = $rawArr['id_str'];
        $result['name'] = $rawArr['name'];
        $result['screen_name'] = $rawArr['screen_name'];
        $result['location'] = $rawArr['location'];
        $result['profile_location'] = $rawArr['profile_location'];
        $result['description'] = $rawArr['description'];
        $result['url'] = $rawArr['url'];
        $result['followers_count'] = $rawArr['followers_count'];
        $result['friends_count'] = $rawArr['friends_count'];
        $result['listed_count'] = $rawArr['listed_count'];
        $result['created_at_t'] = $rawArr['created_at'];
        $result['favourites_count'] = $rawArr['favourites_count'];
        $result['utc_offset'] = $rawArr['utc_offset'];
        $result['time_zone'] = $rawArr['time_zone'];
        $result['geo_enabled'] = $rawArr['geo_enabled'];
        $result['verified'] = $rawArr['verified'];
        $result['statuses_count'] = $rawArr['statuses_count'];
        $result['lang'] = $rawArr['lang'];
        $result['status_created_at'] = $rawArr['status']['created_at'];
        $result['status_id'] = $rawArr['status']['id'];
        $result['status_id_str'] = $rawArr['status']['id_str'];
        $result['status_text'] = $rawArr['status']['text'];
        $result['status_source'] = $rawArr['status']['source'];
        $result['status_retweet_count'] = $rawArr['status']['retweet_count'];
        $result['status_favorite_count'] = $rawArr['status']['favorite_count'];
        // $result['status_entities'] = $rawArr[''];
        $result['profile_background_color'] = $rawArr['profile_background_color'];
        $result['profile_background_image_url'] = $rawArr['profile_background_image_url'];
        $result['profile_background_image_url_https'] = $rawArr['profile_background_image_url_https'];
        $result['profile_image_url'] = $rawArr['profile_image_url'];
        $result['profile_image_url_https'] = $rawArr['profile_image_url_https'];
        $result['profile_banner_url'] = $rawArr['profile_banner_url'];
        $result['profile_link_color'] = $rawArr['profile_link_color'];
        $result['profile_sidebar_border_color'] = $rawArr['profile_sidebar_border_color'];
        $result['profile_sidebar_fill_color'] = $rawArr['profile_sidebar_fill_color'];
        $result['profile_text_color'] = $rawArr['profile_text_color'];
        $result['profile_use_background_image'] = $rawArr['profile_use_background_image'];

        return $result;
    }
}