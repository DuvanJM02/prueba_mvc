<?php

require __DIR__ . "../../Controllers/AuthController.php";
require __DIR__ . "../../Models/Contact.php";

class ContactController {

    public static function index(): array {
        $sessionKey = AuthController::login();
        // URL de la petición con la $sessionKey del servidor
        $url = "https://develop1.datacrm.la/jdimate/pruebatecnica/webservice.php?operation=query&sessionName=$sessionKey&query=select%20*%20from%20Contacts;";
        $contacts = [];

        try{
            $response = file_get_contents($url);
            
            if ($response === false) die('Error al obtener la respuesta');
        }catch(\Exception $e){
            throw "Error al conectar con la API" . $e->getMessage();
        }

        $json_results = json_decode($response, true)['result'];
        
        foreach($json_results as $data){
            array_push($contacts, new Contact($data['id'], $data['contact_no'], $data['lastname'], $data['createdtime']));
        }

        return $contacts;
    }

}