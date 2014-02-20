# Ultimo Twitter Rest
OO Twitter Rest API 1.1 Client

This is and will be WIP, as I only add new object types and functions when needed.

## Requirements
* PHP 5.3
* Ultimo Oauth
* Ultimo Http
* Ultimo Dobject

## Usage
	$oAuth = new \ultimo\security\oauth\v1_0\OAuth(
        $consumer_key,
       	$consumer_secret,
        $token,
        $token_secret
    );
    
    $http = new \ultimo\net\http\Client(new \ultimo\net\http\adapters\Curl());
    $twitterClient = new \ultimo\api\twitter\rest\v1_1\Client($oAuth, $http);

	$tweets = $twitterClient->getUserTimeline(array('screen_name' => 'robvanaarle', 'count' => 3));