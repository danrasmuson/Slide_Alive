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
 *   Fetch all funding sources for the
 *   account associated with the provided
 *   OAuth token
 **/
$fundingSources = $Dwolla->fundingSources();
if(!$fundingSources) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($fundingSources); }

/**
 * EXAMPLE 2: 
 *   Fetch detailed information for the
 *   funding source with a specific ID
 **/
$fundingSourceId = 'a4946ae2d2b7f1f880790f31a36887f5';
$fundingSource = $Dwolla->fundingSource($fundingSourceId);
if(!$fundingSource) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($fundingSource); }

/**
 * EXAMPLE 3: 
 *   Initiate a withdraw from Dwolla balance
 *   and into a funding source with a specific ID
 **/
$fundingSourceId = 'a4946ae2d2b7f1f880790f31a36887f5';
$amount = "1.00";
$withdraw = $Dwolla->withdraw($fundingSourceId, $pin, $amount);
if(!$withdraw) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($withdraw); }

/**
 * EXAMPLE 4: 
 *   Initiate a deposit from a funding source 
 *   with a specific ID, and into Dwolla
 **/
$fundingSourceId = 'a4946ae2d2b7f1f880790f31a36887f5';
$amount = "1.00";
$deposit = $Dwolla->deposit($fundingSourceId, $pin, $amount);
if(!$deposit) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($deposit); }

/**
 * EXAMPLE 5: 
 *   Add a funding source for the user associated 
 *   with the authorized access token.
 **/
$accountNumber = '';
$routingNumber = '';
$accountType = 'Checking';
$accountName = 'My Checking Account';

$newFundingSource = $Dwolla->addFundingSource($accountNumber, $routingNumber, $accountType, $accountName);
if(!$newFundingSource) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($newFundingSource); }

/**
 * EXAMPLE 6: 
 *   Verify a funding source for the user associated 
 *   with the authorized access token.
 **/
$fundingSourceId = '';
$deposit1 = '0.05';
$deposit2 = '0.07';

$verifiedFundingSource = $Dwolla->verifyFundingSource($fundingSourceId, $deposit1, $deposit2);
if(!$verifiedFundingSource) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { print_r($verifiedFundingSource); }
