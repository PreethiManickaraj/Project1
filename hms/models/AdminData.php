<?php 

/** 
 *  AdminData model class is used to perform operations in Admin table.
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class AdminData
{
    const TABLE_NAME = 'admin';
    private $dbConnect;
    /**
     *  Method for instantiates the object for class.
     *  call the connect function to connect the database.
     */
    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        $this->dbConnect = $dbConnect->connect();
    }
    /**
     *  Method for select all data from admin table.
     *  @param string $email has the email id of user.
     *  @param string $password has password of user
     *  @var string $table has a table name.
     *  @var array $stmt has the query statement.
     *  @return array $records has the result data.
     */
    public function selectAdmin($email,$password)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table where
        email = ? AND password = ? LIMIT 1");
        $stmt->execute([$email,$password]); 
        $records = $stmt->fetchAll();
        return $records;
    }
    /**
     *  Method for select admin details.
     *  @var string $table has the table name.
     *  @var array $stmt has the query statement.
     *  @return array $records has the result data.
     */
    public function profile()
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT * FROM $table");
        $stmt->execute(); 
        $records = $stmt->fetchAll();
        return $records;
    }
}