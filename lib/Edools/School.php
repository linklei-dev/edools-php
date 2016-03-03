<?php namespace Edools;

class School extends APIResource {

  public static function fetch($key)    { return self::fetchAPI($key); }

  public static function wizard($attributes=Array()) {
    try {
      $response = self::API()->request(
        "POST",
        static::url($attributes) . "/wizard",
        $attributes
      );

      if (isset($response->errors)) {
        return false;
      }
      $new_object = self::createFromResponse( $response );
      return $new_object;

    } catch (Exception $e) {
      return false;
    }

    return false;
  }



}
