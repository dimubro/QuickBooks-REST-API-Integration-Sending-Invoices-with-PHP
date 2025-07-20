<?php

include 'authorization_code.php';

$accessToken = get_authorization_code();
$realmId = "Client ID";

$apiUrl = "https://sandbox-quickbooks.api.intuit.com/v3/company/$realmId/query?query=SELECT%20*%20FROM%20Customer";

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $accessToken",
    "Accept: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200) {
    $data = json_decode($response, true);
    echo "<h3>Customer List:</h3>";
    foreach ($data['QueryResponse']['Customer'] as $customer) {
        echo "ID: " . $customer['Id'] . " - Name: " . $customer['DisplayName'] . "<br>";
    }
} else {
    echo "Error fetching customers: " . $response;
}
?>