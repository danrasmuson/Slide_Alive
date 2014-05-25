# dwolla-php: PHP Wrapper for Dwolla's API
=================================================================================

## Version 

1.5.5

## Requirements
- [PHP](http://www.php.net/)
- [CURL PHP](http://php.net/manual/en/book.curl.php)
- [JSON PHP](http://php.net/manual/en/book.json.php)

## Installation

The recommended way to install dwolla-php is [through
composer](http://getcomposer.org). Just create a `composer.json` file and
run the `php composer.phar install` command to install it:

    {
        "require": {
            "dwolla/dwolla-php": "1.5.4"
        }
    }

Alternatively, you can simply include dwolla.php in your PHP code

## Usage
```php
require 'dwolla.php';
$Dwolla = new DwollaRestClient();
$Dwolla->setToken('[OAuth Token Goes Here]');

// Send money to a given Dwolla ID
$transactionId = $Dwolla->send('[PIN]', '812-734-7288', 1.00);
```

## Generating Application Credentials

To acquire an application `key` and `secret` pair, you'll need to [create a new Application on Dwolla](https://www.dwolla.com/applications/create).  It's free, quick, and easy!

If you'd like to use the API to act only behalf of your own account (i.e. to make payments from your account, check your account balance), you can generate an OAuth token for your account [here](https://developers.dwolla.com/dev/token).

## Examples

This repo includes various usage examples, including:

* Authenticating with OAuth [oauth.php]
* Sending money [send.php]
* Fetching account information [accountInfo.php]
* Grabbing a user's contacts [contacts.php]
* Listing a user's funding sources [fundingSources.php]
* Creating offsite gateway sessions [offsiteGateway.php]

Before trying out the examples, you'll need to specify your Application credentials (`key`, `secret`, an OAuth Token for your account, and your account's `PIN` -- see the above section on how to acquire these) in the `_keys.dist.php` file.  Then rename the file to `_keys.php` and you're all set!

## Methods

Authentication Methods:

    getAuthUrl()        ==> (string) OAuth permissions page URL
    requestToken($code) ==> (string) a never-expiring OAuth access token
    setToken($token)    ==> (bool) was token saved?
    getToken()          ==> (string) current OAuth token

Users Methods:

    me()                ==> (array) the user entity associated with the token
    getUser($user_id)   ==> (array) the user entity for {$user_id}
    usersNearby($lat, $long)  ==> (array) users nearby the given geolocation
    
Register Methods:

    register($email, $password, $pin, $firstName, $lastName, $address, $address2, $city, $state, $zip, $phone, $dateOfBirth, $acceptTerms[, $type, $organization, $ein])    ==> (array) the newly created user record
    
Contacts Methods:

    contacts([$search, $types, $limit])         ==> (array) list of contacts matching the search criteria
    nearbyContacts([$search, $types, $limit])   ==> (array) list of nearby spots matching the search criteria
    
Funding Sources Methods:

    fundingSources()    ==> (array) a list of funding sources associated with the token
    fundingSource($id)  ==> (array) information about the {$id} funding source
    addFundingSource($accountNumber, $routingNumber, $accountType, $accountName)  ==>
    verifyFundingSource($fundingSourceId, $deposit1, $deposit2) ==> 
    withdraw($fundingSourceId, $pin, $amount) ==>
    deposit($fundingSourceId, $pin, $amount)  ==> 

MassPay Methods:
    
    massPayCreate($pin, $email, $filedata, $assumeCosts = FALSE, $source = FALSE, $user_job_id = FALSE)
    massPayDetails($uid, $job_id = FALSE, $user_job_id = FALSE, $include_details = FALSE)
    
Balance Methods:

    balance()           ==> (string) the Dwolla balance of the account associated with the token

Requests Method:

    request($pin, $sourceId, $amount[, $sourceType, $notes, $facilitatorAmount])  ==> (string) request ID
    requests()
    requestById($requestId)
    fulfillRequest($requestId, $pin, $amount = false, $notes = false, $fundsSource = false, $assumeCosts = false)
    cancelRequest($requestId)
    
Transactions Methods:

    guestsend($destinationId, $amount, $firstName, $lastName, $email, $routingNumber, $accountNumber, $accountType[, $assumeCosts, $destinationType, $notes, $groupId, $additionalFees, $facilitatorAmount, $assumeAdditionalFees])   ==> (string) 
    send($pin, $destinationId, $amount[, $destinationType, $notes, $facilitatorAmount, $assumeCosts])   ==> (string) transaction ID
    transaction($transactionId)                     ==> (array) transaction details
    listings([$sinceDate, $types, $limit, $skip])   ==> (array) a list of recent transactions matching the search criteria
    stats([$types, $sinceDate, $endDate])           ==> (array) statistics about the account associated with the token
    
Offsite Gateway Methods:

    startGatewaySession()                                           ==> (bool) did session start?
    addGatewayProduct($name, $amount[, $quantity, $description])    ==> (bool) was product added?
    verifyGatewaySignature($signature, $checkoutId, $amount)        ==> (bool) is signature valid?
    getGatewayURL($destinationId[, $orderId, $discount, $shipping, $tax, $notes, $callback])    ==> (string) checkout URL
    
Helper Methods:

    getError()          ==> (string) error message
    parseDwollaID($id)  ==> (bool) is valid Dwolla ID?
    setMode($mode)      ==> (bool) did mode change?
    setDebug($mode)     ==> (bool) set debug [verbose] mode
    setSandbox($mode)   ==> (bool) changes API URL to Sandbox/UAT URL

## Changelog

1.5.5
* Added Sandbox support via setSandbox(bool) to make it easier to switch between sandbox/non-sandbox testing. 

1.5.4
* Add guestSend() and added param include_details back to massPayDetails().  (Thanks, @tim-peterson!)

1.5.3

* Implement a replacement for getallheaders for non-Apache envs (Thanks, @PrplHaz4)

1.5.2

* Add error handling for requestToken() (Thanks, CFG / @CoGoFinance)
* Add more curl debug reporting

1.5.1

* Fixed the transaction/listings() delimiter (Thanks, @klobyone)

1.5

* Added massPayCreate(), massPayDetails()
* Added MassPay examples

1.4.1

* Fix me() method by adding trailing slash (Thanks, @brettneese)

1.4

* Fix offsite gateway signature verification fn
* Add Webhook signature verification fn
* Add Webhook signature verification example

1.3.2

* Modify transaction/byId to use app creds rather than oauth token (thanks to @chrishiestand)

1.3.1

* Implemented nearbyContacts (thanks to @brettneese)

1.3

* Fixed CAINFO cert issue on non-Win machines
* Add users/nearby() method
* Add contacts/nearby() method
* Add requests/pending() method
* Add requests/byId() method
* Add requests/fulfill() method
* Add requests/cancel() method
* Add fundingSources/withdraw() method
* Add fundingSources/deposit() method
* Add fundingSources/add() method
* Add fundingSources/verify() method
* Clean up examples
* Add debug mode for verbose operations

1.2.6

* Fix listings() method

1.2.5

* Set an error message when signature validation fails

1.2.4

* Round the offsite gateway total amount

1.2.3

* Add support for offsite gateway's guest checkout mode

1.2.2 (Thanks to Chris Hiestand)

* Added the fundsSource parameter to the Send() method

1.2.0 (Thanks to Jeremy Kendall)

* Major code refactor, reformat to PSR
* Changed license to MIT License
* Added register user example

1.1.0 (Thanks to Jeremy Kendall)

* Added tests
* Added support for composer
* Renamed _keys.php to _keys.dist.php

1.0.0

* Added support for Dwolla's offsite gateway
* Refactored methods
* Extended documentation

## Credits

- Michael Schonfeld
- Jeremy Kendall &lt;http://about.me/jeremykendall&gt;

## Support

- Dwolla API &lt;api@dwolla.com&gt;
- Gordon Zheng &lt;gordon@dwolla.com&gt;

## References / Documentation

http://developers.dwolla.com/dev

## License 

(The MIT License)

Copyright (c) 2012 Dwolla &lt;michael@dwolla.com&gt;

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
