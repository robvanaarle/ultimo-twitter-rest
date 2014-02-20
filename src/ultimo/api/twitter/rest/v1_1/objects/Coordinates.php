<?php

namespace ultimo\api\twitter\rest\v1_1\objects;

class Coordinates extends \ultimo\api\twitter\rest\v1_1\Object {
  const TYPE_POINT = 'Point';
  
  public $coordinates;
  public $type;
}