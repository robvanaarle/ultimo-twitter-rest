<?php

namespace ultimo\api\twitter\rest\v1_1;

use ultimo\net\http\Client as HttpClient;
use ultimo\net\http\XRequest as HttpRequest;

class Client {
  protected $oauth;
  
  protected $http;
  
  /**
   *
   * @var \ultimo\util\dobject\ObjectBuilder
   */
  public $objectBuilder;
  
  protected $baseUrl = 'https://api.twitter.com/1.1/';
  
  public function __construct(\ultimo\security\oauth\v1_0\OAuth $oauth, HttpClient $http) {
    $this->oauth = $oauth;
    $this->http = $http;
    $this->objectBuilder = new \ultimo\util\dobject\ObjectBuilder(array(
        'Contributor' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\Contributor',
        ),
        'Coordinates' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\Coordinates',
        ),
        'Hashtag' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\Hashtag',
        ),
        'Medium' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\Medium',
          'sizes' => 'Sizes'
        ),
        'SearchMetadata' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\SearchMetadata',
        ),
        'SearchResult' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\SearchResult',
          'statuses' => 'Tweet[]',
          'search_metadata' => 'SearchMetadata'
        ),
        'Size' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\Size',
        ),
        'Sizes' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\Sizes',
          'thumb' => 'Size',
          'large' => 'Size',
          'medium' => 'Size',
          'small' => 'Size'
        ),
        'Tweet' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\Tweet',
          'contributors' => 'Contributor[]',
          'coordinates' => 'Coordinates',
          'entities' => 'TweetEntities',
          'metadata' => 'TweetSearchMetadata',
          'retweeted_status' => 'Tweet',
          'user' => 'User'
        ),
        'TweetSearchMetadata' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\TweetSearchMetadata', 
        ),
        'TweetEntities' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\TweetEntities',
          'hashtags' => 'Hashtag[]',
          'media' => 'Medium[]',
          'urls' => 'Url[]',
          'user_mentions' => 'UserMention[]'
        ),
        'Url' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\Url',
        ),
        'User' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\User',
          'entities' => 'UserEntities',
          'status' => 'Tweet[]'
        ),
        'UserEntities' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\UserEntities',
          'url' => 'UserUrl'
        ),
        'UserMention' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\UserMention',
        ),
        'UserUrl' => array(
          '__class' => 'ultimo\api\twitter\rest\v1_1\objects\UserUrl',
          'urls' => 'Url[]'
        ),
        //RetweetEntities
    ));
  }
  
  public function getUserTimeline(array $params=array()) {
    return $this->getRequest('statuses/user_timeline', $params, 'Tweet[]');
  }
  
  public function getTweet(array $id, $params=array()) {
    $getParams = array_merge($params, array(
      'id' => $id
    ));
    return $this->getRequest('statuses/show', $getParams, 'Tweet');
  }
  
  public function searchTweets($q, array $params = array()) {
    $getParams = array_merge($params, array(
      'q' => $q
    ));
    return $this->getRequest('search/tweets', $getParams, 'SearchResult');
  }
  
  protected function getRequest($action, $getParams, $type, $allowNull=false) {
    $request = new HttpRequest($this->baseUrl . $action . '.json');
    $request->setGetParams($getParams);
    
    return $this->request($request, $type, $allowNull);
  }
  
  protected function request(HttpRequest $request, $type, $allowNull) {
    // add oAuth Authorization header
    $header = $this->oauth->generateHeader(
            $request->getMethod(),
            $request->getUrl(false),
            array_merge($request->getPostParams(), $request->getGetParams())
            );
    $request->setHeader($header);
    
    $response = $this->http->request($request);
    $body = $response->getBody();
    
    $data = json_decode($body, true);
    
    // connection error handling
    if (json_last_error() != JSON_ERROR_NONE) {
      throw new exceptions\ConnectionException("Invalid json: {$body}", exceptions\ConnectionException::INVALID_RESPONSE);
    }
    
    // check if data is null if no allowed
    if (!$allowNull && $data === null) {
      throw new exceptions\ConnectionException("Invalid response: {$body}", exceptions\ConnectionException::INVALID_RESPONSE);
    }
    
    // client error handling
    if (isset($data['errors']) && is_array($data['errors'])) {
      if (count($data['errors']) > 0) {
        // nest each error using previous exception
        $exception = null;
        foreach (array_reverse($data['errors']) as $error) {
          $exception = new exceptions\ClientException($error['message'], $error['code'], $exception);
        }
        throw $exception;
      } else {
        // somehow there is an error, but without a message
        throw new exceptions\ClientException("Empty client exception");
      }
    }
    
    return $this->objectBuilder->build($data, $type);
  }
  
}