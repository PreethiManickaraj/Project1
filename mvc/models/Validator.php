<?php 

/**
 *  Validator class is used to validate the form data
 */
class Validator {
    /**
     * @var array $errors is used to store error message and display errrors
     * @var array $fields is used to store form post data.
     */
    public $errors = [];
    public $fields = [];

    /**
     *  constructor function stores the values in the $fields.
     */

    public function  __construct($fields)
    {
        $this->fields = $fields;
    }

    /**
     *  process abstract method validates fields
     */
    public function process($postParams)
    {
        // $fields stores name of fields and $fieldType stores types of fields
        foreach($this->fields as $field => $fieldType) {
            // $fieldValue has values of fields
            $fieldValue = '';
            // if field is empty shows error message
            if(!($fieldValue = $this->isEmpty($field, $postParams))) {
                $this->errors[] = sprintf('%s is a required field.', ucwords($field));
            } else {
                // else checks the type of fields
                $this->validateField( $field, $fieldType, $fieldValue);
            }
        }
        return $this->errors;
    }
    public function success($postParams)
    {   
        /**
         *  returns Success Message if registration is successfull
         */
        return 'Registration Successfull !!!';
    }

    public function validateField($field, $type, $value) 
    {   
        /**
         *  checks email pattern and type is email
         */
        if($type === 'email' && !$this->isEmail($value)) {
            $this->errors[] = sprintf('%s requires valid email id.', ucwords($field));
        }
        if($type === 'string' && !$this->isString($value,$field)){
            
        }
    }

    public function isEmail($email)
    {
        /**
         *  checks that the given email is given in email format
         */
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
          }
    }

    public function isString($value,$field)
    {   
        /**
         *  checks for string format
         */
        if (!preg_match("/^[a-zA-Z-' ]*$/",$value)) {
            $this->errors[] = sprintf('%s requires valid string format.', ucwords($field));
        }
    }

    public function isEmpty($field, $postParams)
    {
        /**
         *  checks that the field is empty or not
         */
        return $postParams[$field] ?? false;
    }
}
