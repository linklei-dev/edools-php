<?php namespace Edools;

class Course extends APIResource {

    public static function get($course_id = null)
    {
        try {

            $url = static::url();
            if ($course_id) {
                $url = "{$url}/{$course_id}";
            }

            $response = self::API()->request(
                "GET",
                $url,
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
