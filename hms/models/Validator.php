<?php 

/**
 *  Validator class validates the fields
 *  @var array $error used to store error messages
 *  @var array $fields used to store fields and datatypes
 */
class Validator
{
    public $errors = [];
    public $fields = [];
    /**
     *  Method for declaring fields.
     *  @param string $fields has the fields given in the form.
     */
    public function  __construct($fields)
    {
        $this->fields = $fields;
    }
    /**
     *  Method for processing the data.
     *  This method checks that the field is empty or not
     *  validates the fields and field type.
     *  @param array $postParams has the post data values given in the form.
     *  @var string $fieldvalue has the field value.
     *  @return array returns the errors array.
     */
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
    /**
     * Method for validate the fields and type of fields.
     * @param string $field has the field.
     * @param string $type has the type of field.
     * @param string $value has the field value.
     */
    public function validateField($field, $type, $value) 
    {   
        if($type === 'email' && !$this->isEmail($value)) {
            $this->errors[] = sprintf('%s requires valid email id.', ucwords($field));
        }
    }
    /** 
     *  Method for checking the email format.
     *  @param string $email has the email value.
     *  @return bool return true if format is correct.
     */
    public function isEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
    }
    /**
     *  Method for checking the field is empty or not.
     *  @param string $field has the field value.
     *  @param array $postParams has the post data values.
     *  @return string returns the value of fields in post data else false
     */
    public function isEmpty($field, $postParams)
    {
        return $postParams[$field] ?? false;
    }
}