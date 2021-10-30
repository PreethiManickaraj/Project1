<?php

class Toasterpro  extends Toaster{

    public function __construct() {

        parent:: __construct();
        $this -> size = 4;
    }

    public function toastfast() {
        foreach ($this->slices as $i => $slice) {
            echo "Toasting " . ($i+1). " ".$slice." with fast option". "<br>";
        }
    }
} 