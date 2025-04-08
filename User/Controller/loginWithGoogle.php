<?php
session_start();
include "./PHPMailer/src/PHPMailer.php";
include "./PHPMailer/src/SMTP.php";

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../model/user.php';

use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;

$client = new Google_Client();
$client->setClientId('528005034084-e8mk4t9eba6804reri2l4qg6njlmpg9f.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/Web-SuShi-PHP/User/Controller/loginWithGoogle.php');
$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

if (!isset($_GET['code'])) {
    $authUrl = $client->createAuthUrl();
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit();
} else {
    try {
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $client->setAccessToken($token['access_token']);
        
        $oauth = new Google_Service_Oauth2($client);
        $userInfo = $oauth->userinfo->get();

        // Kiểm tra email đã có trong DB chưa
        $ur = new user();
        $existingUser = $ur->getUserByEmail($userInfo->email);

        if ($existingUser) {
            // Đăng nhập
            $_SESSION['makh'] = $existingUser['makh'];
            $_SESSION['tenkh'] = $existingUser['tenkh'];
            $_SESSION['username'] = $existingUser['username'];
            header('Location: http://localhost/Web-SuShi-PHP/User/index.php?action=main');
            exit();
        } else {
            // Chuyển sang trang bổ sung thông tin đăng ký Google
            $_SESSION['email'] = $userInfo->email;
            $_SESSION['google_name'] = $userInfo->name;
            header('Location: http://localhost/Web-SuShi-PHP/User/Controller/dangky.php?act=google_register');

            exit();
        }

    } catch (Exception $e) {
        echo 'Lỗi khi lấy thông tin người dùng: ' . $e->getMessage();
        exit();
    }
}
