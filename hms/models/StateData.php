<?php 
/**
 *  StateData model class used to perform operations in state table
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class StateData
{
    const TABLE_NAME = 'state';
    private $dbConnect;
    /**
     *  Method for instantiates the object for class.
     *  connecting the database.
     */
    public function __construct()
    {
        $dbConnect =  new dbConnect();;
        $this->dbConnect = $dbConnect->connect();
    }
    /**
     *  Method for selecting all the states name from table.
     *  @var string $table has the state table
     *  @return array return all states from state table.
     */
    public function selectState()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table ORDER BY id desc");
    }
}