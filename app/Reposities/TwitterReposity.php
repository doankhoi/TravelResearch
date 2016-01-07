<?php

namespace App\Reposities;
use App\Models\TList;
use Twitter;
use Exception;

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
            throw new Exception("Error Processing Request");
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
            throw new Exception("Error Processing Request");
        }
    }

    private function __convertToArrayTwitter($rawArr)
    {
        $result = [];
        $result['t_id'] = array_key_exists("id", $rawArr) ? $rawArr['id'] : '';
        $result['t_id_str'] = array_key_exists("id_str", $rawArr) ? $rawArr['id_str'] : '';
        $result['name'] = array_key_exists("name", $rawArr) ? $rawArr['name'] : '';
        $result['screen_name'] = array_key_exists("screen_name", $rawArr) ? $rawArr['screen_name'] : '';
        $result['location'] = array_key_exists("location", $rawArr) ? $rawArr['location'] : '';
        $result['profile_location'] = array_key_exists("profile_locationo", $rawArr) ? $rawArr['profile_location'] : '';
        $result['description'] = array_key_exists("description", $rawArr) ? $rawArr['description'] : '';
        $result['url'] = array_key_exists("url", $rawArr) ? $rawArr['url'] : '';

        if (array_key_exists("url", $rawArr['entities'])) {
            $result['entities_url_url'] = array_key_exists("url", $rawArr['entities']['url']['urls'][0]) ? $rawArr['entities']['url']['urls'][0]['url'] : '';
            $result['entities_url_expanded_url'] = array_key_exists("expanded_url", $rawArr['entities']['url']['urls'][0]) ? $rawArr['entities']['url']['urls'][0]['expanded_url'] : '';
            $result['entities_url_display_url'] = array_key_exists("display_url", $rawArr['entities']['url']['urls'][0]) ? $rawArr['entities']['url']['urls'][0]['display_url'] : '';
        }
        
        if (array_key_exists("url", $rawArr['entities'])) {
            $result['entities_description_url'] = array_key_exists("url", $rawArr['entities']['description']['urls'][0]) ? $rawArr['entities']['description']['urls'][0]['url'] : '';
            $result['entities_description_expanded_url'] = array_key_exists("expanded_url", $rawArr['entities']['description']['urls'][0]) ? $rawArr['entities']['description']['urls'][0]['expanded_url'] : '';
            $result['entities_description_display_url'] = array_key_exists("display_url", $rawArr['entities']['description']['urls'][0]) ? $rawArr['entities']['description']['urls'][0]['display_url'] : '';
        }
        
        $result['followers_count'] = array_key_exists("followers_count", $rawArr) ? $rawArr['followers_count'] : '';
        $result['friends_count'] = array_key_exists("friends_count", $rawArr) ? $rawArr['friends_count'] : '';
        $result['listed_count'] = array_key_exists("listed_count", $rawArr) ? $rawArr['listed_count'] : '';
        $result['created_at_t'] = array_key_exists("created_at", $rawArr) ? $rawArr['created_at'] : '';
        $result['favourites_count'] = array_key_exists("favourites_count", $rawArr) ? $rawArr['favourites_count'] : '';
        $result['utc_offset'] = array_key_exists("utc_offset", $rawArr) ? $rawArr['utc_offset'] : '';
        $result['time_zone'] = array_key_exists("time_zone", $rawArr) ? $rawArr['time_zone'] : '';
        $result['geo_enabled'] = array_key_exists("geo_enabled", $rawArr) ? $rawArr['geo_enabled'] : '';
        $result['verified'] = array_key_exists("verified", $rawArr) ? $rawArr['verified'] : '';
        $result['statuses_count'] = array_key_exists("statuses_count", $rawArr) ? $rawArr['statuses_count'] : '';
        $result['lang'] = array_key_exists("lang", $rawArr) ? $rawArr['lang'] : '';
        if (array_key_exists("status", $rawArr)) {
            $result['status_created_at'] = array_key_exists("created_at", $rawArr["status"]) ? $rawArr['status']['created_at'] : '';
            $result['status_id'] = array_key_exists("id", $rawArr["status"]) ? $rawArr['status']['id'] : '';
            $result['status_id_str'] = array_key_exists("id_str", $rawArr["status"]) ? $rawArr['status']['id_str']: '';
            $result['status_text'] = array_key_exists("text", $rawArr["status"]) ? $rawArr['status']['text'] : '';
            $result['status_source'] = array_key_exists("source", $rawArr["status"]) ? $rawArr['status']['source'] : '';
            $result['status_retweet_count'] = array_key_exists("retweet_count", $rawArr["status"]) ? $rawArr['status']['retweet_count'] : 0;
            $result['status_favorite_count'] = array_key_exists("favorite_count", $rawArr["status"]) ? $rawArr['status']['favorite_count'] : 0;
        }
        
        // $result['status_entities'] = $rawArr[''];
        $result['profile_background_color'] = array_key_exists("profile_background_color", $rawArr) ? $rawArr['profile_background_color'] : '';
        $result['profile_background_image_url'] = array_key_exists("profile_background_image_url", $rawArr) ? $rawArr['profile_background_image_url'] : '';
        $result['profile_background_image_url_https'] = array_key_exists("profile_background_image_url_https", $rawArr) ? $rawArr['profile_background_image_url_https'] : '';
        $result['profile_image_url'] = array_key_exists("profile_image_url", $rawArr) ? $rawArr['profile_image_url'] : '';
        $result['profile_image_url_https'] = array_key_exists("profile_image_url_https", $rawArr) ? $rawArr['profile_image_url_https'] : '';
        $result['profile_banner_url'] = array_key_exists("profile_banner_url", $rawArr) ? $rawArr['profile_banner_url'] : '';
        $result['profile_link_color'] = array_key_exists("profile_link_color", $rawArr) ? $rawArr['profile_link_color'] : '';
        $result['profile_sidebar_border_color'] = array_key_exists("profile_sidebar_border_color", $rawArr) ? $rawArr['profile_sidebar_border_color'] : '';

        $result['profile_sidebar_fill_color'] = array_key_exists("profile_sidebar_border_color", $rawArr) ? $rawArr['profile_sidebar_fill_color'] : '';
        $result['profile_text_color'] = array_key_exists("profile_text_color", $rawArr) ? $rawArr['profile_text_color'] : '';
        $result['profile_use_background_image'] = array_key_exists("profile_use_background_image", $rawArr) ? $rawArr['profile_use_background_image'] : '';

        return $result;
    }
}