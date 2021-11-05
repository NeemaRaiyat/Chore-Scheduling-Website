<?php
// This file simply makes obtaining the users email and name much easier
class User {

    private $name;      // Private variables for better encapsualtion and security
    private $email;

    function __construct($id) {
        $db = new Database();
        $user = $db->querySingle("SELECT * FROM USERS WHERE ID='$id'");
        $this->name = $user['NAME'];
        $this->email = $user['EMAIL'];
    }
    function getName() {
        return $this->name;
    }
    function getEmail() {
        return $this->email;
    }
}

?>