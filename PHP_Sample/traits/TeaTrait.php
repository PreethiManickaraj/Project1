<?php

trait TeaTrait {

    public function makeTea(){
        echo static::class .' making tea '."<br>";
    }
}