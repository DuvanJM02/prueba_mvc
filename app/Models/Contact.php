<?php

class Contact {
    private $id, $contact_no, $lastname, $createdtime;

    public function __construct($id, $contact_no, $lastname, $createdtime)
    {
        $this->id = $id;
        $this->contact_no = $contact_no;
        $this->lastname = $lastname;
        $this->createdtime = $createdtime;
    }

    public function getId(): string{
        return $this->id;
    }
    public function getContactNo(): string{
        return $this->contact_no;
    }
    public function getLastname(): string{
        return $this->lastname;
    }
    public function getCreatedtime(): string{
        return $this->createdtime;
    }
}