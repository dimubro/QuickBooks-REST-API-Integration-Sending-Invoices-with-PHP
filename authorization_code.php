<?php

function get_authorization_code(){
$client_id = 'Client ID';
$client_secret = 'Client Secret';
$refresh_token = 'Refresh_token'; // You get this from the database before you save it.

$token_url = 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer';

// Encode client ID and secret for Basic Auth
$auth_header = base64_encode("$client_id:$client_secret");

// Prepare POST data
$post_fields = http_build_query([
    'grant_type' => 'refresh_token',
    'refresh_token' => $refresh_token
]);

$ch = curl_init($token_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded',
    'Authorization: Basic ' . $auth_header,
    'Accept: application/json'
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);


if ($http_code == 200) {
    $tokens = json_decode($response, true);

    $new_access_token = $tokens['access_token'];
    $new_refresh_token = $tokens['refresh_token'];
    $expires_in = $tokens['expires_in']; // usually 3600 seconds
    $refresh_expires_in = $tokens['x_refresh_token_expires_in']; // ~100 days

    
    
    return $new_access_token;
    

} else {
    
}
}

?>