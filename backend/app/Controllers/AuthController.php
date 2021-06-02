<?php

namespace App\Controllers;

use Simple\Support\Theme;
use Simple\Database\Adaptor;

class AuthController 
{
    public static function login() {
        // PAGE RELOAD (이미 로그인 되어있을 때)
        if (isset($_SESSION['user_id'])) 
        {
            header('Location: /'); //redirect user back to page  
            return;
        }

        //include google api files
        $client = new \Google_Client();
        $client->setApplicationName('model-signifier-314200');
        $client->setAuthConfig(dirname(__DIR__, 2) . '/private/client_secret.json');
        $client->addScope(\Google_Service_Oauth2::USERINFO_PROFILE);
        $client->addScope(\Google_Service_Oauth2::USERINFO_EMAIL);

        $google_oauthV2 = new \Google_Service_Oauth2($client);

        // GOOGLE CALLBACK
        if (isset($_GET['code']))
        {
            $client->authenticate($_GET['code']);
            $token = $client->getAccessToken();

            $client->setAccessToken($token);
            
            $user = $google_oauthV2->userinfo->get();

            // die(var_dump($user));
            // db에 user data 없으면 넣기.

            
            $count = count(Adaptor::getAll('SELECT * FROM user WHERE email = ?', [$user['email']]));

            // 해당 user의 data가 db에 없을 때
            if($count === 0) {
                Adaptor::exec(
                    'INSERT INTO user(`email`, `name`, `image_path`) VALUES(?, ?, ?)', 
                    [$user['email'], $user['givenName'] . ' ' .  $user['family_name'], $user['picture']]);
            }
            
            // user id 가져오기
            $user_in_db = current(Adaptor::getAll('SELECT * FROM user WHERE email = ?', [$user['email']]));
            //App::get('database')->query($sql);

            $_SESSION['user_id'] = $user_in_db->id;

            header('Location: /'); //redirect user back to page
            return;
        }

        
        
        // GOOGLE LOG-IN PAGE
        $authUrl = $client->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    }

    public static function logout() {
        unset($_SESSION['user_id']);
        header('Location: /'); //redirect user back to page
        return;
    }
}
