<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use Facebook\Exceptions\FacebookSDKException;
use App\Reposities\FacebookReposity;
use Session;

class WebsiteController extends Controller
{
    protected $_fb;
    protected $_token;
    protected $_faceReposity;

    public function __construct(LaravelFacebookSdk $fb)
    {
        $this->_fb = $fb;
        $this->_faceReposity = new FacebookReposity($fb);
    }
    
    public function index()
    {
        $disableFace = "";
        return view('websites.index', compact('disableFace'));
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
                return redirect(route('top'))->with(compact('message', 'alertClass'));
            }
        }

        $this->_fb->setDefaultAccessToken($token);

        // Save for later
        Session::put('fb_user_access_token', (string) $token);

        $message = "Login successfully";
        $alertClass = "alert-success";
        $disableFace = "disabled";
        return redirect(route('top'))->with(compact('message', 'alertClass', 'disableFace'));
    }

    public function updateListFanpage()
    {
        try {
            $this->_faceReposity->storeOrUpdate('visitkyushu');
        } catch (Exception $e) {
            $message = "API not avaiable.";
            $alertClass = "alert-danger";
            return redirect(route('top'))->with(compact('message', 'alertClass'));
        }
    }
}
