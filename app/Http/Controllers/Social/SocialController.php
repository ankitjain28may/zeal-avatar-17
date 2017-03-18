<?php

namespace App\Http\Controllers\Social;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Image;

class SocialController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // OAuth Two Providers
        $token = $user->token;
        $refreshToken = $user->refreshToken; // not always provided
        $expiresIn = $user->expiresIn;

        // All Providers
        $id = $user->getId();
        $name = $user->getName();

        $img = Image::make('https://graph.facebook.com/v2.8/'.$id.'/picture?type=large');

        $height = $img->height();
        $width = $img->width();


        $overlay = Image::make(storage_path('app/public/Z16.png'))->resize($width, $height);


        $img->insert($overlay);

        $img->save(storage_path('app/share/'.$id.'.jpg'));

        return $img->response('jpg');

    }
}
