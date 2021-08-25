<?php 

class Validator
{
    public $errors = [];
    public $fields = [];

    public function  __construct($fields)
    {
        $this->fields = $fields;
    }

    public function process($postParams)
    {
        foreach($this->fields as $field => $fieldType){
            $fieldValue = '';
            if(!($fieldValue = $this->isEmpty($field, $postParams))) {
                $this->errors[] = sprintf('%s is a required field.', ucwords($field));
            } else {
                $this->validateField( $field, $fieldType, $fieldValue);
            }
        }
        return $this->errors;
    }
    public function validateField($field, $type, $value) 
    {   
        if($type === 'email' && !$this->isEmail($value)) {
            $this->errors[] = sprintf('%s requires valid email id.', ucwords($field));
        }
    }
    public function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
          }
    }
    public function isEmpty($field, $postParams)
    {
        return $postParams[$field] ?? false;
    }
}