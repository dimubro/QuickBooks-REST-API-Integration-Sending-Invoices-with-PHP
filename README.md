# QuickBooks-REST-API-Integration-Sending-Invoices-with-PHP
<h2>QuickBooks REST API Integration: Sending Invoices with PHP</h2>

<h3>Step-by-Step Instructions:</h3>

<ol>
  <li>
    <strong>Get the Refresh Token</strong><br>
    First, you need to get a refresh token and save it in your database.<br>
    <em>➤ The refresh token is valid for 100 days.</em>
  </li>

  <li>
    <strong>Get the Access Token</strong><br>
    Use the saved refresh token to request an access token.<br>
    <em>➤ The access token is valid for 60 minutes.</em>
  </li>

  <li>
    <strong>Send Customer Details to QuickBooks</strong><br>
    Use the access token to send customer details to QuickBooks via the Customer Insert REST API.<br>
    <em>➤ You will receive a Customer ID in the response.</em>
  </li>

  <li>
    <strong>Send Invoice Details</strong><br>
    After getting the Customer ID, you can use it to send invoice details to QuickBooks.
  </li>
</ol>
