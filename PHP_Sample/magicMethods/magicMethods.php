<?php 
// property overloading
class MagicMethods 
{
    public array $data = [];
    public function __get(string $name)
   {
       if(array_key_exists($name,$this->data)){
           return $this->data[$name];
       }
       return null;
   }
   public function __set(string $name,$value)
   {
       $this->data[$name]=$value;
   } 
   public function __isset(string $name)
   {
       echo "isset ";
       return array_key_exists($name,$this->data);
   }
   public function __unset(string $name)
   {
       echo "unset ";
       return($this->data[$name]); 
   }
}