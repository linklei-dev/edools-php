<?php

class Edools_APIRequest {
  public function __construct() {
  }

  private function _defaultHeaders($headers = Array()) {
    $headers[] = 'Authorization: Token token="' . Edools::getApiKey() . '"' ;
    $headers[] = "Accept: application/json";
    $headers[] = "Accept-Charset: utf-8";
    $headers[] = "User-Agent: Edools PHPLibrary";
    $headers[] = "Accept-Language: pt-br;q=0.9,pt-BR";
    return $headers;
  }

  public function request($method, $url, $data=Array()) {
    global $edools_last_api_response_code;

    if (Edools::getApiKey() == null) {
      Edools_Utilities::authFromEnv();
    }

    if ( Edools::getApiKey() == null ) throw new EdoolsAuthenticationException("Chave de API não configurada. Utilize Edools::setApiKey(...) para configurar.");

    $headers = $this->_defaultHeaders();

    print_r($url);

    list( $response_body, $response_code ) = $this->requestWithCURL( $method, $url, $headers, $data );

    $response = json_decode($response_body);


    if (json_last_error() != JSON_ERROR_NONE) throw new EdoolsObjectNotFound($response_body);
    if ($response_code == 404) throw new EdoolsObjectNotFound($response_body);

    if (isset($response->errors)) {

      if ((gettype($response->errors) != "string") && count(get_object_vars($response->errors)) == 0) {
        unset($response->errors);
      }
      else if ((gettype($response->errors) != "string") && count(get_object_vars($response->errors)) > 0) {
        $response->errors = (Array) $response->errors;
      }

      if (isset($response->errors) && (gettype($response->errors) == "string")) {
        $response->errors = $response->errors;
      }
    }

    $edools_last_api_response_code = $response_code;

    return $response;
  }

  private function encodeParameters($method,$url,$data=Array()) {

    $method = strtolower($method);

    switch($method) {
    case "get":
    case "delete":
      $paramsInURL = Edools_Utilities::arrayToParams( $data );
      $data = null;
      $url = (strpos($url,"?")) ? $url . "&" . $paramsInURL : $url . "?" . $paramsInURL;
      break;
    case "post":
    case "put":
      $data = Edools_Utilities::arrayToParams( $data );
      break;
    }

    return Array($url,$data);
  }

  private function requestWithCURL( $method, $url, $headers, $data=Array() ) {
    $curl = curl_init();

    $opts = Array();

    list($url,$data) = $this->encodeParameters($method,$url,$data);

    if (strtolower($method) == "post") {
      $opts[CURLOPT_POST] = 1;
      $opts[CURLOPT_POSTFIELDS] = $data;
    }
    if (strtolower($method) == "delete") $opts[CURLOPT_CUSTOMREQUEST] = 'DELETE';

    if (strtolower($method) == "put") {
      $opts[CURLOPT_CUSTOMREQUEST] = 'PUT';
      $opts[CURLOPT_POSTFIELDS] = $data;
    }

    $opts[CURLOPT_URL] = $url;
    $opts[CURLOPT_RETURNTRANSFER] = true;
    $opts[CURLOPT_CONNECTTIMEOUT] = 30;
    $opts[CURLOPT_TIMEOUT] = 80;
    $opts[CURLOPT_RETURNTRANSFER] = true;
    $opts[CURLOPT_HTTPHEADER] = $headers;

    $opts[CURLOPT_SSL_VERIFYHOST] = 2;
    $opts[CURLOPT_SSL_VERIFYPEER] = true;
    $opts[CURLOPT_CAINFO] = realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "data") . DIRECTORY_SEPARATOR . "ca-bundle.crt";

    curl_setopt_array($curl, $opts);

    $response_body = curl_exec($curl);
    $response_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    return Array($response_body, $response_code);
  }
}
