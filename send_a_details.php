<?php
include 'authorization_code.php';
$accessToken = get_authorization_code();
$realmId = "CLient ID";

$apiUrl = "https://sandbox-quickbooks.api.intuit.com/v3/company/$realmId/invoice";

$data = [
    "CustomerRef" => ["value" => "2"], // You want to insert a customer into QuickBooks and need to get the Customer ID. The Customer Insert REST API code is also available in this repository.
    "Line" => [
        [
            "DetailType" => "DescriptionOnly",
            "Amount" => 100.00,
            "Description" => "Custom Service - No ItemRef"
        ]
    ]
];

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $accessToken",
    "Accept: application/json",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200 || $httpCode == 201) {
    echo "Invoice created successfully: $response";
} else {
    echo "Error: $response";
}
?>