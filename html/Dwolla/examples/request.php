<?php
// Include the Dwolla REST Client
require '../lib/dwolla.php';

// Include any required keys
require '_keys.php';

// Instantiate a new Dwolla REST Client
$Dwolla = new DwollaRestClient();

// Seed a previously generated access token
$Dwolla->setToken($token);
$Dwolla->setDebug(true);


/**
 * EXAMPLE 1: 
 *   Get list of pending requests
 **/
$requests = $Dwolla->requests();
if(!$requests) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($requests); }

/**
 * EXAMPLE 2: 
 *   Request money ($1.00) to a Dwolla ID 
 **/
$requestId = $Dwolla->request('812-713-9234', 1.00);
if(!$requestId) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { echo("Request ID: {$requestId} \n"); }

/**
 * EXAMPLE 3: 
 *   Get request by ID
 **/
$request = $Dwolla->requestById($requestId);
if(!$request) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($request); }

/**
 * EXAMPLE 4: 
 *   Cancel request with ID
 **/
$canceledRequest = $Dwolla->cancelRequest($requestId);
if(!$canceledRequest) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { echo("Canceled? {$canceledRequest} \n"); }

/**
 * EXAMPLE 5: 
 *   Fulfill request with ID
 **/
$fulfilledRequest = $Dwolla->fulfillRequest($requestId, $pin);
if(!$fulfilledRequest) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($fulfilledRequest); }

