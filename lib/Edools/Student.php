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

    public static function get_by_id($id)
    {
        $result = self::get_students(['ids', $id]);
        $response = null;

        if ($result && !empty($result->students)) {
            foreach ($result->students as $student) {
                if ((string) $student->id === (string) $id) {
                    $response = $student;
                    break;
                }
            }
        }
        return $response;
    }

    /**
     * Cria usuario na edools.
     * Parametros obrigatorios:
     *  user[first_name]	String: User first name
     *  user[email]	String: User email that should be uniq
     *  user[password]	String: Should be greater than 6 chars
     *  user[password_confirmation]	String: Should be equal the password
     *
     * @param null $attributes
     * @return SearchResult|false|mixed|null
     */
    public static function create($attributes = null)
    {
        try {
            $response = self::API()->request(
                "POST",
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

    /**
     * Deleta usuario estudante da edools.
     *
     * @param $id
     * @return SearchResult|false|mixed|null
     */
    public static function delete($id)
    {

        try {
            $response = self::API()->request(
                "DELETE",
                static::url($id),
                $id
            );

            // Se nao retornar resposta, deletou o registro.
            if (!$response) {
                return true;
            }

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

    /**
     * Cria credenciais de login para o usuario.
     * Retorna um objeto User da Edools, com um novo hash para login no atributo credentials.
     *
     * @param null $attributes
     * @return SearchResult|false|mixed|null
     */
    public static function sign_in($attributes = null)
    {
        try {
            $response = self::API()->request(
                "POST",
                Config::getBaseURI() . '/users/sign_in',
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
