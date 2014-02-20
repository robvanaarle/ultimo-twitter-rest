<?php

namespace ultimo\api\twitter\rest\v1_1\objects;

class SearchResult extends \ultimo\api\twitter\rest\v1_1\Object {
  public $statuses;
  
  /**
   *
   * @var SearchMetadata 
   */
  public $search_metadata;
}