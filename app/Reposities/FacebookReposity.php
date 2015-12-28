<?php
namespace App\Reposities;

use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;
use App\Restful\Constants;
use App\Models\FList;

/**
* Store data from facebook
*/

class FacebookReposity
{
	private $__fb;

	public function __construct($fb)
	{
		$this->__fb = $fb;
	}

	/**
	 * Store or update data of fanpage
	 * @param string $name screen_name of fanpage
     * @throws FacebookSDKException
	 * @return void
	 */
    public function storeOrUpdate($name) 
	{
		try {
            $response = $this->__fb->get('/'.$name.'?'.Constants::FIELDS_API_FANPAGE_INFOMATION_FACEBOOK);
        } catch (FacebookSDKException $e) {
            throw new Exception("Error Processing Request", 1);
        }

        // Convert the response to a `Facebook/GraphNodes/GraphNode` collection
        $page = $response->getGraphNode();

        // Create the user if it does not exist or update the existing entry.
        // This will only work if you've added the SyncableGraphNodeTrait to your User model.
        try {
        	FList::createOrUpdateGraphNode($page);
        } catch (Exception $e) {
        	throw new Exception("Error Processing Request", 1);	
        }
	}
}