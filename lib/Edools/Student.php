<?php namespace Edools;

class Student extends APIResource {

    //public static function fetch($key)    { return self::fetchAPI($key); }

    public static function get_students($attributes = null)
    {
        try {
            $response = self::API()->request(
                "GET",
                static::url($attributes),
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
