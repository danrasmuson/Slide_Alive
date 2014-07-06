<?php
// Include the Dwolla REST Client
require '../lib/dwolla.php';

// Include any required keys
require '_keys.php';

// Instantiate a new Dwolla REST Client
$Dwolla = new DwollaRestClient();

// Seed a previously generated access token
$Dwolla->setToken($token);


/**
 * EXAMPLE 1: 
 *   Send money ($1.00) to a Dwolla ID 
 **/

    $destinationId='';
    $amount='0.05';
    $firstName='Michael';
    $lastName='Schonfeld'
    $email='michael@dwolla.com';   
    $routingNumber='';
    $accountNumber='';
    $accountType='';   


$transactionId = $Dwolla->guestsend($destinationId, $amount, $firstName, $lastName, $email, $routingNumber, $accountNumber, $accountType, $assumeCosts=false, $destinationType = 'Dwolla', $notes = '', $groupId =false, $additionalFees=false, $facilitatorAmount = 0, $assumeAdditionalFees = false);
if(!$transactionId) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { echo "Guest Send transaction ID: {$transactionId} \n"; } // Print Transaction ID


