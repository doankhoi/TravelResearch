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
use App\Http\Requests\Website\StoreTwitterRequest;
use App\Models\TList;
use Twitter;
use Input;
use App\Reposities\TwitterReposity;

class WebsiteController extends Controller
{
    protected $_fb;
    protected $_token;
    protected $_faceReposity;
    protected $_twitterReposity;
    protected $_itemPerPage = 100;

    public function __construct(LaravelFacebookSdk $fb)
    {
        $this->_fb = $fb;
        $this->_faceReposity = new FacebookReposity($fb);
        $this->_twitterReposity = new TwitterReposity();
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
                //abort(403, 'Unauthorized action.');
                $message = "Unauthorized action.";
                $alertClass = "alert-danger";
                Session::put('face_logined', false);
                return redirect(route('top'))->with(compact('message', 'alertClass'));
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
        try {
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
        } catch (Exception $e) {
            $message = "Error when create CSV facebook.";
            $alertClass = "alert-danger";
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        }
    }

    ///////////////////////////////////////
    ///             Twitter           /////
    ///////////////////////////////////////
    public function addTwitter()
    {
        return view('websites.add_twitter');
    }

    public function storeScreenName(StoreTwitterRequest $request)
    {
        try {
            TList::create($request->all());
            $message = "Store screen_name successfully.";
            $alertClass = "alert-success";
        } catch (Exception $e) {
            $message = "Store screen_name error.";
            $alertClass = "alert-danger";
        }
        return redirect(route('top'))->with(compact('message', 'alertClass'));
    }

    public function listTwitter()
    {
        $listTwitter = TList::paginate($this->_itemPerPage);
        return view('websites.listtwitter', compact('listTwitter'));
    }

    public function downloadTwitter()
    {
        try {
            $listTwitter = DB::table('tlist')->select(
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
            'profile_use_background_image')->get();

            $listTwitter = array_map(function($item) {
                return (array) $item;
            }, $listTwitter);

            Excel::create('ListTwitter', function($excel) use ($listTwitter) {
                $excel->sheet('Sheet', function($sheet) use($listTwitter) {
                    $sheet->fromArray($listTwitter);
                });
            })->download('csv');
        } catch (Exception $e) {
            $message = "Error when create CSV twitter.";
            $alertClass = "alert-danger";
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        }
    }

    public function loginTwitter()
    {
        $signInTwitter = true;
        $forceLogin = false;
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken(route('twitter.callback'));

        if (isset($token['oauth_token_secret'])) {
            $url = Twitter::getAuthorizeURL($token, $signInTwitter, $forceLogin);

            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

            return redirect($url);
        }

        $message = "Auth twitter error.";
        $alertClass = "alert-danger";
        return redirect(route('top'))->with(compact('message', 'alertClass'));
    }

    public function twitterCallback()
    {
        if (Session::has('oauth_request_token')) {
            $requestToken = [
                'token'  => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];

            Twitter::reconfig($requestToken);

            $oauthVerifier = false;

            if (Input::has('oauth_verifier')) {
                $oauthVerifier = Input::get('oauth_verifier');
            }

            // getAccessToken() will reset the token for you
            $token = Twitter::getAccessToken($oauthVerifier);

            if (!isset($token['oauth_token_secret'])) {
                $message = "You could not login on Twitter.";
                $alertClass = "alert-danger";
                Session::put('twitter_loged', false);
                return redirect(route('twitter.login'))->with(compact('message', 'alertClass'));
            }

            $credentials = Twitter::getCredentials();

            if (is_object($credentials) && !isset($credentials->error)) {
                Session::put('access_token', $token);
                Session::put('twitter_loged', true);
                $message = "Login twitter successfully";
                $alertClass = "alert-success";
                return redirect(route('top'))->with(compact('message', 'alertClass'));
            }

            $message = "Crash when login.";
            $alertClass = "alert-danger";
            Session::put('twitter_loged', false);
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        }
    }

    public function updatedListTwitter()
    {
        try {
            $this->_twitterReposity->updatedListTwitter();
            $message = "Update list twitter successfully.";
            $alertClass = "alert-success";
        } catch (Exception $e) {
            $message = "Error update list twitter.";
            $alertClass = "alert-danger";
        }

        return redirect(route('top'))->with(compact('message', 'alertClass'));
    }
}
