<?php

class Promotion {
    public function __construct(
        private float $amount ,
        private ?string $description = null
    ) {
        $this->amount = $amount;
        $this->description = $description;
        echo $this->description."<br>";
        echo $amount;
    }
}
$a = new Promotion(3,'hello');
