<?php
// Include the Dwolla REST Client
require '../lib/dwolla.php';

// Include any required keys
require '_keys.php';

// Instantiate a new Dwolla REST Client
$Dwolla = new DwollaRestClient($apiKey, $apiSecret);

// Seed a previously generated access token
$Dwolla->setToken($token);
$Dwolla->setDebug(true);

/**
 * EXAMPLE 1: 
 *   Fetch account information for the
 *   account associated with the provided
 *   OAuth token
 **/
$me = $Dwolla->me();
if(!$me) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($me); } // Print user information


/**
 * EXAMPLE 2: 
 *   Fetch basic account information
 *   for a given Dwolla ID
 **/
$user = $Dwolla->getUser('812-546-3855');
if(!$user) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($user); } // Print user information

/**
 * EXAMPLE 3: 
 *   Fetch basic account information
 *   for a given Email address
 **/
$user = $Dwolla->getUser('michael@dwolla.com');
if(!$user) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($user); } // Print user information

/**
 * EXAMPLE 4: 
 *   Get users nearby a given geolocation
 **/
$lat = "40.708322";
$long = "-74.0147477";

$users = $Dwolla->usersNearby($lat, $long);
if(!$users) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($users); }