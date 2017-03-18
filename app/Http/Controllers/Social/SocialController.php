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

        // All Providers
        $id = $user->getId();
        $nickname = $user->getNickname();
        $name = $user->getName();
        $email = $user->getEmail();
        $avatar = $user->getAvatar();



        $img = Image::make('https://graph.facebook.com/v2.8/'.$id.'/picture?width=603&height=603');

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
