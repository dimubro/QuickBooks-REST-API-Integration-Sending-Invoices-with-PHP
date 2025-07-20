<?php 
    $client_id = 'Client ID';
    $redirect_uri = 'redirect url'; // You add the path to the callback.php file.
    $scope = 'com.intuit.quickbooks.accounting openid profile email phone address';

    $auth_url = 'https://appcenter.intuit.com/connect/oauth2?' . http_build_query([
        'client_id' => $client_id,
        'redirect_uri' => $redirect_uri,
        'response_type' => 'code',
        'scope' => $scope,
        'state' => 'random_string_here' 
    ]);

    
    header("Location: $auth_url");
    exit;

?>
