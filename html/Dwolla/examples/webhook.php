<?php
// Include the Dwolla REST Client
require '../lib/dwolla.php';

// Include any required keys
require '_keys.php';

// Instantiate a new Dwolla REST Client
$Dwolla = new DwollaRestClient($apiKey, $apiSecret);

/*
 * Before processing the Webhook notification,
 * we need to validate Dwolla's signature
 */
if(!$Dwolla->verifyWebhookSignature()) {
  die("Invalid signature!");
}

/*
 * Now we can process the notification
 * by parsing its body...
 */
$parsedBody = json_decode(file_get_contents('php://input'), TRUE);
print_r($parsedBody);