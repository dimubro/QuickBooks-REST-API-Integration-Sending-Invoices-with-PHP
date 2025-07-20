<?php
include 'authorization_code.php';
$access_token = get_authorization_code();
$realm_id = "ClientID";

$url = "https://sandbox-quickbooks.api.intuit.com/v3/company/$realm_id/customer"; // Use "sandbox" or "quickbooks" based on environment
			$customer_data = [
		    "GivenName" => "Raveen",
		    "FamilyName" => "Priyadarashana",
		    "DisplayName" => "Raveen Priyadarashana",
		    "PrimaryEmailAddr" => [
		        "Address" => "raveen@gmail.com"
		    ],
		    "PrimaryPhone" => [
		        "FreeFormNumber" => "+94123456789"
		    ],
		    "BillAddr" => [
		        "Line1" => "44/balabowa",
		        "City" => "Gampaha",
		        "Country" => "Sri Lanka"
		    ]
		];
    $json_data = json_encode($customer_data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $access_token",
        "Content-Type: application/json",
        "Accept: application/json"
    ]);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200 || $http_code == 201) {
        $result = json_decode($response, true);
        $customer_id = $result['Customer']['Id'];
        return $customer_id;
    } else {
        echo "Error creating customer (HTTP $http_code):\n$response";
        return false;
    }

?>
