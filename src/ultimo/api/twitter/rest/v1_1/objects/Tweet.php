<?php

namespace ultimo\api\twitter\rest\v1_1\objects;

class Tweet extends \ultimo\api\twitter\rest\v1_1\Object {
 
  public $annotation;
  public $contributors;
  public $coordinates;
  public $created_at;
  public $current_user_retweet;
  
  /**
   *
   * @var Entities
   */
  public $entities;
  public $favorited;
  public $geo;
  public $id;
  public $id_str;
  public $in_reply_to_screen_name;
  public $in_reply_to_status_id;
  public $in_reply_to_status_id_str;
  public $in_reply_to_user_id;
  public $in_reply_to_user_id_str;
  /**
   *
   * @var TweetSearchMetadata
   */
  public $metadata;
  public $place;
  public $possibly_sensitive;
  public $scopes;
  public $retweet_count;
  public $retweeted;
  /**
   *
   * @var Tweet
   */
  public $retweeted_status;
  public $source;
  public $text;
  public $truncated;
  public $user;
  public $withheld_copyright;
  public $withheld_in_countries;
  public $withheld_scope;
}