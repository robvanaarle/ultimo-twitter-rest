<?php

namespace ultimo\api\twitter\rest\v1_1\objects;

class Medium extends \ultimo\api\twitter\rest\v1_1\Object {
  public $display_url;
  public $expanded_url;
  public $id;
  public $id_str;
  public $indices;
  public $media_url;
  public $media_url_https;
  
  /**
   *
   * @var Sizes
   */
  public $sizes;
  public $source_status_id;
  public $source_status_id_str;
  public $type;
  public $url;
}