<?php namespace Edools;

class Certificate extends APIResource {

    /**
     * Retorna lista com Todos os certificados emitidos para usuarios alunos da escola.
     *
     * @param $school_id
     * @return SearchResult|false|mixed|null
     */
    public static function get_certificates($school_id)
    {
        try {
            $url = Config::getBaseURI() . "/schools/{$school_id}/certificates";
            $response = self::API()->request(
                "GET",
                $url,
                ['enrollment_id' => 123]
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
     * Busca por um objeto Certificado, recebendo o ID do certificado.
     *
     * @param $certificate_id
     * @return SearchResult|false|mixed|null
     */
    public static function get($certificate_id)
    {

        try {
            $response = self::API()->request(
                "GET",
                static::url() . "/{$certificate_id}",
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
