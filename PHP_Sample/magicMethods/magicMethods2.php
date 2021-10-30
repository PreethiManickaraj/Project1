<?php 

class MethodOverloading 
{
    private $id = 1;
    private $accNo = 123456789;
    public function process(float $amount,string $description)
    {
        var_dump($amount,$description);
    }
    public function __call(string $name,array $arguments)
    {
        if(method_exists($this,$name)){
            call_user_func_array([$this,$name],$description);
        }
    }
    public static function __callStatic(string $name,array $arguments)
    {
        var_dump($name,$arguments);
    }
    public function __toString()
    {
        return 'hello';
    }
    public function __invoke()
    {
        var_dump("invoked");
    }
    public function __debugInfo()
    {
        return [
            'id'=>$this->id,
            'acc no'=>'*****'.substr($this->accNo,-4)
        ];
    }
}