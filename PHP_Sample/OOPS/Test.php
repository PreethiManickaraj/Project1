<?php 

include_once './dbConnect.php';

class Test extends dbConnect {

    public function getUsers() {
        $sql = "SELECT * FROM customers";
        $stmt = $this->connect()->query($sql);
        while($row=$stmt->fetch()){
            echo $row['cname']."<br>";
        }
    }

    public function getUsersStmt($cname) {
        $sql = "SELECT * FROM customers WHERE cname = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$cname]);
        $names = $stmt->fetchAll();

        foreach($names as $i){
            echo $i['cname']."<br>";
        }
    }

    public function setUser($cname,$cpass,$cemail) {
        $sql = "INSERT INTO customers(cname,cpass,cemail)VALUES(?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$cname,$cpass,$cemail]);
        
    }
}