<?php

class Login extends dbConnect {

    //private $firstname;

    public function selectData($firstname,$password){
        $sql = "SELECT firstname FROM userdata WHERE firstname = $firstname";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$firstname,$password]);
        $names = $stmt->fetchALL();
        return $names;
    }
}
?>
