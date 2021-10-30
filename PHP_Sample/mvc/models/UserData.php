<?php 
/**
 *  UserData model class used to perform operations in database
 */
class UserData 
{   // @var TABLE_NAME is a constant of table name
    const TABLE_NAME = 'userdata';

    //instance of dbConnect class
    private $dbConnect;

    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        // instantiates for dbConnect class
        $this->dbConnect = $dbConnect->connect();
    }
    /**
     *  registerUser method is used to insert registered data
     */
    public function registerUser($firstname,$lastname,$email,$password)
    {
        $tableName = self::TABLE_NAME;
       
        if(!$this->isExistingUser($email)) {
            //$query = "INSERT INTO  $tableName(firstname,lastname,email,password)VALUES(?,?,?,?)";
            $stmt = $this->dbConnect->prepare("INSERT INTO $tableName(firstname,lastname,email,password)VALUES(?,?,?,?)");
            $stmt->execute([$firstname, $lastname, $email, $password]);
        } else {
            throw new EntityAlreadyExistsException(sprintf('%s user already exists.', $email));
        }
    }

    public function isExistingUser($email)
    {
        $tableName = self::TABLE_NAME;

        $stmt = $this->dbConnect->prepare("SELECT * FROM $tableName WHERE email=?");
        $stmt->execute([$email]); 
        $records = $stmt->fetchAll();

        return count($records) > 0 ? true : false;
    }

    /**
     *  loginUser method is used to select email from database of user
     */
    public function loginUser($email,$password)
    {
        $this->selectRow(self::TABLE_NAME);
    }
}