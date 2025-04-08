<?php
session_start();
include "./PHPMailer/src/PHPMailer.php";
include "./PHPMailer/src/SMTP.php";

require_once __DIR__ . '/../vendor/autoload.php';  // Đảm bảo Composer autoload được bao gồm
require_once '../model/user.php';  // Đảm bảo bạn đã tạo file user.php trong thư mục model

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

        // Kiểm tra nếu email đã có trong cơ sở dữ liệu
        $ur = new user();
        $existingUser = $ur->getUserByEmail($userInfo->email);

        if ($existingUser) {
            // Nếu người dùng đã tồn tại, lưu thông tin vào session
            $_SESSION['makh'] = $existingUser['makh'];
            $_SESSION['tenkh'] = $existingUser['tenkh'];
            $_SESSION['username'] = $existingUser['username'];
            header('Location: http://localhost/Web-SuShi-PHP/User/index.php?action=main');
            exit();
        } else {
            // Nếu người dùng chưa có, chuyển hướng đến trang đăng ký
            $_SESSION['email'] = $userInfo->email;  // Lưu email vào session
            $_SESSION['google_name'] = $userInfo->name;  // Lưu tên vào session
            header('Location: http://localhost/Web-SuShi-PHP/User/Controller/dangky_google.php');
            exit();
        }

    } catch (Exception $e) {
        echo 'Lỗi khi lấy thông tin người dùng: ' . $e->getMessage();
        exit();
    }
}
?>
