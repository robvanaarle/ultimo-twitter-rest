<?php

namespace ultimo\api\twitter\rest\v1_1\objects;

class User extends \ultimo\api\twitter\rest\v1_1\Object {
  public $contributors_enabled;
  public $created_at;
  public $default_profile;
  public $default_profile_image;
  public $description;
  /**
   *
   * @var Entities
   */
  public $entities;
  public $favourites_count;
  public $follow_request_sent;
  public $following;
  public $followers_count;
  public $friends_count;
  public $geo_enabled;
  public $id;
  public $id_str;
  public $is_translator;
  public $lang;
  public $listed_count;
  public $location;
  public $name;
  public $notifications;
  public $profile_background_color;
  public $profile_background_image_url;
  public $profile_background_image_url_https;
  public $profile_background_tile;
  public $profile_banner_url;
  public $profile_image_url;
  public $profile_image_url_https;
  public $profile_link_color;
  public $profile_sidebar_border_color;
  public $profile_sidebar_fill_color;
  public $profile_text_color;
  public $profile_use_background_image;
  public $protected;
  public $screen_name;
  public $show_all_inline_media;
  /**
   *
   * @var Tweets
   */
  public $status;
  public $statuses_count;
  public $time_zone;
  public $url;
  public $utc_offset;
  public $verified;
  public $withheld_in_countries;
  public $withheld;
}