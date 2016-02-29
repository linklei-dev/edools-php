<?php

class EdoolsAuthenticationException extends Exception {}
class EdoolsRequestException extends Exception {}
class EdoolsObjectNotFound extends Exception {}
class EdoolsException extends Exception {}

abstract class EdoolsResource {
}

abstract class Edools {
  const VERSION = "0.1.0";

  public static $api_key = null;
  public static $api_version = "v1";
  public static $endpoint = "https://api.edools.com";

  public static function getBaseURI() {
   return self::$endpoint . "/" . self::$api_version;
  }

  public static function setApiKey( $_api_key ) {
    self::$api_key = $_api_key;
  }

  public static function getApiKey() {
    return self::$api_key;
  }
}
