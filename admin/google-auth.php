<?php

require './admin/vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;

$clientId = 'YOUR_CLIENT_ID';
$clientSecret = 'YOUR_CLIENT_SECRET';
$redirectUri = 'YOUR_REDIRECT_URI';

$provider = new GoogleAuth([
    'clientId' => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri' => $redirectUri,
]);

// If we don't have an authorization code, redirect the user to the authorization URL
if (!isset($_GET['code'])) {
    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;
}

// Verify the state matches our stored state
if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
}

// Try to get an access token using the authorization code grant
$token = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

// Use $token to access the user's data or make API requests
echo 'Access Token: ' . $token->getToken();
echo 'Refresh Token: ' . $token->getRefreshToken();
echo 'Expires: ' . $token->getExpires();

// Now you can use the access token to interact with Google APIs
