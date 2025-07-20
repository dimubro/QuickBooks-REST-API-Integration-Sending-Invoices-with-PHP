<?php 
    $client_id = 'Client ID';
    $redirect_uri = 'https://cleesecatering.com/site/quick_book/call-back.php'; // Must match what is registered in Intuit app
    $scope = 'com.intuit.quickbooks.accounting openid profile email phone address';

    $auth_url = 'https://appcenter.intuit.com/connect/oauth2?' . http_build_query([
        'client_id' => $client_id,
        'redirect_uri' => $redirect_uri,
        'response_type' => 'code',
        'scope' => $scope,
        'state' => 'random_string_here' // Optional, for security
    ]);

    // Redirect to QuickBooks login
    header("Location: $auth_url");
    exit;

?>