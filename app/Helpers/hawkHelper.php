<?php

namespace App\Helpers;
use Illuminate\Http\Request;

use Shawm11\Hawk\Client\Client as HawkClient;
use Shawm11\Hawk\Client\ClientException as HawkClientException;

class hawkHelper {
// A fictional function that makes an authenticated request to the server
	public static function makeRequest($requestData)
	{
	    $hawkClient = new HawkClient;
	    $result = [];
	    $uri = 'https://app.fracttal.com/api/meters_list/SIE0700-P';
	    $options = [
	        // This is required
	        'credentials' => [
	        'id' => 'CVJ9kXEwbfvRepBBUC9',
	        'key' => 'KXSIEbw4nTkngG7q1f5yHltjQjvcE8lZhEsvqp0eJlS02ar4Gx3YjxH',
	        'algorithm' => 'sha256'
	        ]
	    ];

	    try {
	        $result = $hawkClient->header($uri, 'POST', $options);
	    } catch (HawkClientException $e) {
	        echo 'ERROR: ' . $e->getMessage();
	        return;
	    }

	    $header = $result['header']; // a string
	    $artifacts = $result['artifacts']; // an array

	    // A fake function that sets the header
	    //etHeaderSomehow('Authorization', $header);

			//var_dump($header);
	    // Do some more stuff before sending request

	    // Now send the request
	    //sendRequestSomehow(); // Not a real function

	    // Wait for response from server...

	    // Now do some stuff after receiving response (See the `responseCallback`
	    // function below)
	    //return self::responseCallback($hawkClient, $options['credentials'], $artifacts, $header);
	    return $header;
	}

	public static function responseCallback($hawkClient, $credentials, $artifacts,  $header)
	{
			echo "<pre>";
			var_dump($header);
			$out = explode('mac="', $header);
			$mac = str_replace('"','',$out[1]);
	    // Somehow get the headers used in the response
	    $responseHeaders = [
	        // Only need these 3 headers
	        'Server-Authorization: '.$header,
	        //'Server-Authorization' => 'Hawk mac="'.$mac.'", hash="yAF3A3y3uzLvNT2m/nVwsifn1+joCqu0uNWZS8RSv6Y="',
					'WWW-Authentication' => 'some more stuff',
	        'Content-Type' => 'application/json' // A different content type can be used
	    ];
			var_dump($responseHeaders);
	    // Validate the server's response
	    try {
	        // If the server's response is valid, the parsed response headers are
	        // returned as an array
	        $parsedHeaders = $hawkClient->authenticate($responseHeaders, $credentials, $artifacts);
	    } catch (HawkClientException $e) {
	        // If the server's response is invalid, an error is thrown
	        echo 'ERROR: ' . $e->getMessage();
	        return;
	    }

	    // Now do some other stuff with the response
	}
}
