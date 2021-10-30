<?php 

class Cloning
{
    private string $id;
    public function __construct()
    {
        $this->id = 'invoice';
    }
    public function __clone()
    {
        $this->id = 'invoice';
    }
}