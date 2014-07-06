<?php
// Include the Dwolla REST Client
require '../lib/dwolla.php';

// Include any required keys
require '_keys.php';

// Instantiate a new Dwolla REST Client
$Dwolla = new DwollaRestClient();

// Seed a previously generated access token
$Dwolla->setToken($token);

// Work in test mode
$Dwolla->setMode('TEST');

/**
 * EXAMPLE 1: 
 *   Send money ($0.01) to a handful
 *   of Dwolla IDs
 **/
$filedata = array();
$filedata[] = array('destination' => 'b@dwolla.com', 'amount' => '0.01');
$filedata[] = array('destination' => 'alext@dwolla.com', 'amount' => '0.01');

$job = $Dwolla->massPayCreate($pin, 'michael@dwolla.com', $filedata);

if(!$job) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { echo "Job information: \n"; print_r($job); } // Print job info


/**
 * EXAMPLE 2: 
 *   Get information about the previous
 *   job we just created
 **/
$details = $Dwolla->massPayDetails('812-734-7288', $job['job_id']);

if(!$details) { echo "Error: {$Dwolla->getError()} \n"; } // Check for errors
else { echo "Job information: \n"; print_r($details); } // Print job info
