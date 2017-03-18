<?php

namespace App\Http\Controllers\Social;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;

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

        // $user->token;

        // OAuth Two Providers
        $token = $user->token;
        $refreshToken = $user->refreshToken; // not always provided
        $expiresIn = $user->expiresIn;

        // OAuth One Providers
        $token = $user->token;
        $tokenSecret = $user->tokenSecret;

        // All Providers
        // $user->getId();
        // $user->getNickname();
        // $user->getName();
        // $user->getEmail();
        // $user->getAvatar();

        return $user->getAvatar();


        $img = Image::make('https://scontent-lht6-1.xx.fbcdn.net/v/t1.0-9/15268057_779812755489882_6749697980395923366_n.jpg?oh=9c959caa67950f6daccb614a3fbf60b6&oe=5962E962');

        $height = $img->height();
        $width = $img->width();


        $overlay = Image::make('https://raw.githubusercontent.com/ankitjain28may/Zealicon-Profile-pic/master/dall.png')->resize(603,603);

        $height1 = $overlay->height();
        $width1 = $overlay->width();

        /*return var_dump([
            "image-h" => $height,
            "image-w" => $width,
            "overlay-h" => $height1,
            "overlay-w" => $width1
        ]);*/

        $img->insert($overlay)->resize(300, 300);

        return $img->response('jpg');

    }
}
