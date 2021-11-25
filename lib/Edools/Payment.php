<?php namespace Edools;

class Payment extends APIResource {

    public static function get_orders($attributes = null)
    {
        $params_get = '';
        if ($attributes) {
            $params_get = '/?' . http_build_query($attributes);
        }

        try {
            $response = self::API()->request(
                "GET",
                static::url() . $params_get,
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

    public static function get_by_id(int $id)
    {
        try {
            $response = self::API()->request(
                "GET",
                static::url() . "/{$id}",
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
