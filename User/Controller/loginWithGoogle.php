<?php
session_start();
// Generate or retrieve a CSRF token (state)
if (empty($_SESSION['google_oauth_state'])) {
    $_SESSION['google_oauth_state'] = bin2hex(random_bytes(32));
}

include "./PHPMailer/src/PHPMailer.php";
include "./PHPMailer/src/SMTP.php";

require_once __DIR__ . '/../vendor/autoload.php';
require_once '../Model/user.php';

use Google\Client as Google_Client;
use Google\Service\Oauth2 as Google_Service_Oauth2;

$client = new Google_Client();
$client->setClientId('528005034084-e8mk4t9eba6804reri2l4qg6njlmpg9f.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/Web-SuShi-PHP/User/Controller/loginWithGoogle.php');
$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);
$client->setState($_SESSION['google_oauth_state']); // Add state parameter
$client->setPrompt('select_account'); // Luôn hiển thị trang chọn tài khoản
$client->setAccessType('online'); // Đặt kiểu truy cập

if (!isset($_GET['code'])) {
    // Start OAuth flow
    $authUrl = $client->createAuthUrl();
    error_log("Redirecting to Google Auth URL with state: " . $_SESSION['google_oauth_state']);
    header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
    exit();
} else {
    // Handle callback from Google
    try {
        // Verify state to prevent CSRF
        if (!isset($_GET['state']) || ($_GET['state'] !== $_SESSION['google_oauth_state'])) {
            unset($_SESSION['google_oauth_state']);
            error_log("Google Login Error: Invalid state parameter.");
            throw new Exception("Invalid state parameter. CSRF attempt detected?");
        }
        
        // Fetch access token
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
             error_log("Google Login Error: Failed to fetch token - " . $token['error'] . ": " . ($token['error_description'] ?? 'No description'));
            throw new Exception('Failed to retrieve access token: ' . $token['error']);
        }
        $client->setAccessToken($token['access_token']);
        
        // Get user info
        $oauth = new Google_Service_Oauth2($client);
        $userInfo = $oauth->userinfo->get();

        error_log("Google login callback for email: " . ($userInfo->email ?? 'Email not found'));

        if (empty($userInfo->email)) {
            error_log("Google Login Error: Email not provided by Google.");
             throw new Exception("Could not retrieve email address from Google.");
        }

        // Check if user exists in DB
        $ur = new user();
        $existingUser = $ur->getUserByEmail($userInfo->email);

        // Clear the state token now that it's been used
        unset($_SESSION['google_oauth_state']);

        if ($existingUser) {
            // Existing user - Store temporary info and redirect to confirmation page
            error_log("Google Login: Existing user found (ID: " . $existingUser['makh'] . "). Redirecting to confirmation page.");
            $_SESSION['google_temp_user_id'] = $existingUser['makh'];
            $_SESSION['google_temp_email'] = $userInfo->email;
            $_SESSION['google_temp_name'] = $existingUser['tenkh'];
            $_SESSION['google_temp_username'] = $existingUser['username'];
            
            // Redirect to confirmation page
            header('Location: /Web-SuShi-PHP/User/index.php?action=dangnhap&act=google_confirm');
            exit();
        } else {
            // New user - Redirect to complete registration
            error_log("Google Login: New user (Email: " . $userInfo->email . "). Redirecting to registration form.");
            $_SESSION['google_temp_email'] = $userInfo->email; // Use a distinct session key
            $_SESSION['google_temp_name'] = $userInfo->name; // Use a distinct session key
            
            header('Location: /Web-SuShi-PHP/User/index.php?action=dangky&act=google_register');
            exit();
        }

    } catch (Exception $e) {
        // Log the detailed error
        error_log('Google Login Exception: ' . $e->getMessage());
        // Clear state if an error occurred during token exchange or user info fetch
        unset($_SESSION['google_oauth_state']);
        // Show a user-friendly error message
        echo 'Có lỗi xảy ra trong quá trình đăng nhập bằng Google. Vui lòng thử lại sau.';
        echo '<br>Chi tiết lỗi: ' . htmlspecialchars($e->getMessage()); // Show details for debugging if needed
        echo '<br><a href="/Web-SuShi-PHP/User/index.php?action=dangnhap">Quay lại trang đăng nhập</a>';
        exit();
    }
}
