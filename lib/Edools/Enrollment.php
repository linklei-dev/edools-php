<?php namespace Edools;

class Enrollment extends APIResource {


    /**
     * Busca dados da matricula dos alunos.
     * Parametros de busca:
     *  student_id: Integer Identifier of the Student object (route dependence)
     *  course_class_id: Integer Identifier of the CourseClass object (route dependence)
     *  school_product_id: Integer Identifier of the SchoolProduct object (route dependence)
     *
     * Opcionais:
     *  page: String The desired page of results
     *  per_page String: How many objects per page (only works when page is provided)
     *
     * @param null $attributes
     * @return SearchResult|false|mixed|null
     */
    public static function get($attributes = null)
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
