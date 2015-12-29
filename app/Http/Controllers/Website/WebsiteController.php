<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;
use App\Reposities\FacebookReposity;
use Session;
use App\Models\FList;
use App\Restful\Constants;
use Excel;
use DB;

class WebsiteController extends Controller
{
    protected $_fb;
    protected $_token;
    protected $_faceReposity;
    protected $_itemPerPage = 100;

    public function __construct(LaravelFacebookSdk $fb)
    {
        $this->_fb = $fb;
        $this->_faceReposity = new FacebookReposity($fb);
    }
    
    public function index()
    {
        return view('websites.index');
    }

    /**
     * Requied permission login facebook
     * @return Response
     */
    public function loginFacebook()
    {
        $login_url = $this->_fb->getLoginUrl(['email']);
        return redirect($login_url);
    }

    public function facebookCallback()
    {
        // Obtain an access token.
        try {
            $token = $this->_fb->getAccessTokenFromRedirect();
            $this->_token = $token;
        } catch (FacebookSDKException $e) {
            $message = "Not avaiable access token.";
            $alertClass = "alert-danger";
            Session::put('face_logined', false);
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        }

        // Access token will be null if the user denied the request
        // or if someone just hit this URL outside of the OAuth flow.
        if (!$token) {
            // Get the redirect helper
            $helper = $this->_fb->getRedirectLoginHelper();

            if (!$helper->getError()) {
                abort(403, 'Unauthorized action.');
            }

            $message = "User denied the request.";
            $alertClass = "alert-danger";
            Session::put('face_logined', false);
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        }

        if (!$token->isLongLived()) {
            // OAuth 2.0 client handler
            $oauth_client = $this->_fb->getOAuth2Client();
            // Extend the access token.
            try {
                $token = $oauth_client->getLongLivedAccessToken($token);
            } catch (FacebookSDKException $e) {
                $message = "Do'nt extend the access token to long live access token";
                $alertClass = "alert-danger";
                Session::put('face_logined', false);
                return redirect(route('top'))->with(compact('message', 'alertClass'));
            }
        }

        $this->_fb->setDefaultAccessToken($token);

        // Save for later
        Session::put('fb_user_access_token', (string) $token);

        $message = "Login successfully";
        $alertClass = "alert-success";
        Session::put('face_logined', true);
        return redirect(route('top'))->with(compact('message', 'alertClass'));
    }

    public function updateOnlyListFace()
    {
        try {
            $this->_faceReposity->storeOrUpdateAllInfoListFanpage();
            $message = "List fanpage updated.";
            $alertClass = "alert-success";
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        } catch (Exception $e) {
            $message = "API not avaiable.";
            $alertClass = "alert-danger";
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        }
    }

    public function updateAllListFace()
    {
        try {
            $this->_faceReposity->storeOrUpdateAllInfoListFanpage(true);
            $message = "All info list fanpage updated.";
            $alertClass = "alert-success";
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        } catch (Exception $e) {
            $message = "Error.";
            $alertClass = "alert-danger";
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        }
    }

    public function listface()
    {
        $listFanpage = FList::paginate($this->_itemPerPage);
        return view('websites.listface', compact('listFanpage'));
    }

    public function downloadFace()
    {
        $listFanpage = DB::table('flist')->select(
            'serialno', 
            'about',
            'category',
            'category_list_id',
            'category_list_name',
            'checkins',
            'company_overview',
            'cover_cover_id',
            'cover_offset_x',
            'cover_offset_y',
            'cover_source',
            'cover_id',
            'description',
            'founded',
            'likes',
            'links',
            'location_city',
            'location_country',
            'location_latitude',
            'location_longitude',
            'location_state',
            'location_street',
            'location_zip',
            'mission',
            'name2',
            'products',
            'talking_about_count',
            'username',
            'website',
            'were_here_count')->get();

        $listFanpage = array_map(function($item) {
            return (array) $item;
        }, $listFanpage);

        Excel::create('ListFanpageFacebook', function($excel) use ($listFanpage) {
            $excel->sheet('Sheet', function($sheet) use($listFanpage) {
                $sheet->fromArray($listFanpage);
            });
        })->download('csv');
    }
}
