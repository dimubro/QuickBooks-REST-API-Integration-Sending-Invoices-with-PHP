<?php
// This runs after user logs in and approves access
if (isset($_GET['code'])) {
    $auth_code = $_GET['code'];
    $realm_id = $_GET['realmId']; // Save this too

    // Exchange code for tokens
    $client_id = 'Client ID';
    $client_secret = 'Client Secret';
    $redirect_uri = 'Redirect URL'; // inster your redirect your after go to call back;

    $token_url = 'https://oauth.platform.intuit.com/oauth2/v1/tokens/bearer';

    $headers = [
        'Authorization: Basic ' . base64_encode($client_id . ':' . $client_secret),
        'Content-Type: application/x-www-form-urlencoded',
        'Accept: application/json',
    ];

    $post_fields = http_build_query([
        'grant_type' => 'authorization_code',
        'code' => $auth_code,
        'redirect_uri' => $redirect_uri,
    ]);

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200) {
        $token_data = json_decode($response, true);

        
        $access_token = $token_data['access_token'];
        $refresh_token = $token_data['refresh_token'];



        // save this refresh token to your database.
        echo "Access Token: $access_token<br>";
        echo "Refresh Token: $refresh_token<br>";
    } else {
        echo "Failed to get token: $response";
    }
}