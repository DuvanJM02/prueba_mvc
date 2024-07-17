<?php 

class AuthController{

    private static function getKey(): string {
        $url = "https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php?operation=getchallenge&username=prueba";
        $token = "";

        try{
            $response = file_get_contents($url);
        }catch(Exception $e){
            throw "Error al obtener el token" . $e->getMessage();
        }

        $token = json_decode($response, true)['result']['token'];

        return $token;
    }

    public static function login(): string {
        $sessionKey = null;
        $token = AuthController::getKey();
        $accessKey = 'IwIHRvYcgN3SRC2B';
        $accessKeyMD5 = md5($token . $accessKey);
        $url = 'https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php';
        $data = array(
            'operation' => 'login',
            'username' => 'prueba',
            'accessKey' => $accessKeyMD5
        );
        // Convertir la data en una cadena de consulta
        $body = http_build_query($data);
        // Configuración de opciones para el contexto de la petición
        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $body,
            )
        );
        // Crear contexto de la petición
        $context  = stream_context_create($options);

        try{
            $response = file_get_contents($url, false, $context);
        }catch(Exception $e){
            throw "Error al obtener el access Key" . $e->getMessage();
        } 

        $sessionKey = json_decode($response, true)['result']['sessionName'];
        
        return $sessionKey;
    }

}