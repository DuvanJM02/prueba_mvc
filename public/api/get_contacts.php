<?php

require __DIR__ . '../../../app/Controllers/ContactController.php';

$contacts = ContactController::index();

// Imprimir JSON para uso con jQuery
$contactsArray = [];
foreach ($contacts as $contact) {
    $contactsArray[] = [
        'id' => $contact->getId(),
        'contact_no' => $contact->getContactNo(),
        'lastname' => $contact->getLastname(),
        'createdtime' => $contact->getCreatedtime()
    ];
}

header('Content-Type: application/json');
echo json_encode($contactsArray, JSON_PRETTY_PRINT);