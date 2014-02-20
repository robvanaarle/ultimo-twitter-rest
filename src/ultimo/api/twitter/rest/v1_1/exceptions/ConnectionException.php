<?php

namespace ultimo\api\twitter\rest\v1_1\exceptions;

class ConnectionException extends Exception {
  const INVALID_RESPONSE = 1;
  const UNEXPECTED_RESPONSE = 2;
}