<?php
namespace App\Reposities;

use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;
use App\Restful\Constants;
use App\Models\FList;
use Session;
use Exception;

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
	 * Store or update infomation of fanpage
	 * @param string $id Id of fanpage
     * @throws FacebookSDKException
	 * @return void
	 */
    public function storeOrUpdateInfoFanpage($id)
	{
        $id = trim($id);
        if (strlen($id) == 0) {
            return;
        }
        $query = "/".$id.Constants::FIELDS_API_FANPAGE_INFOMATION_FACEBOOK;
		try {
            $this->__fb->setDefaultAccessToken(Session::get('fb_user_access_token', ''));
            $response = $this->__fb->get($query);
        } catch (FacebookSDKException $e) {
            throw new Exception("Error Processing Request");
        }

        try {
            $page = $response->getGraphNode();
            FList::createOrUpdateGraphNode($page);
        } catch (Exception $e) {
        	throw new Exception("Error Processing Request");
        }
	}

    /**
     * Store or update list fanpage
     * @param  boolean $isInfo True: update all info, False: update only list fanpage
     * @throws Exception
     * @return void
     */
    public function storeOrUpdateAllInfoListFanpage($isInfo = false)
    {
        try {
            $this->__fb->setDefaultAccessToken(Session::get('fb_user_access_token', ''));
            $response = $this->__fb->get(Constants::API_LIST_FANPAGE_LIKES);
            $feedEdge = $response->getGraphEdge();
            $creator = Session::get('id_user_face', null);
            if ($creator == null) {
                throw new Exception("Error Processing Request");
            }

            do {
                $arrId = [];
                foreach ($feedEdge as $node) {
                    $nodeArr = $node->asArray();
                    FList::createOrUpdateGraphNode($node);
                    if ($isInfo) {
                        $this->storeOrUpdateInfoFanpage($nodeArr['id']);
                    }
                    $arrId[] = $nodeArr['id'];
                }
                foreach ($arrId as $item) {
                    $flist = FList::where('serialno', $item)->first();
                    if ($flist == null) {
                        continue;
                    }
                    $flist->creator = $creator;
                    $flist->save();
                }
            } while (($feedEdge = $this->__fb->next($feedEdge)));
        } catch (Exception $e) {
            throw new Exception("Error Processing Request");
        }
    }
}