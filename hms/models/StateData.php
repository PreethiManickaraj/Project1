<?php 
/**
 *  StateData model class used to perform operations in state table
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class StateData
{
    const TABLE_NAME = 'state';

    const STATE_ID = 'state_id';

    const STATE_NAME = 'state_name';

    const COUNTRY_ID = 'country_id';

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
     *  Method for selecting state name by country id.
     *  @param int $countryId.
     *  @return query return all states name according to id.
     */
    public function getStateByCountry($countryId)
    {
        return $this->dbConnect->query(
            "SELECT * FROM ".self::TABLE_NAME." where ".self::COUNTRY_ID." = $countryId"
        );
    }
    /**
     *  Method for selecting all states in table.
     *  @return query return all states names.
     */
    public function selectState()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table");
    }
    /**
     *  Method for selecting state name according to state id.
     *  @param int $id is the state_id.
     *  @return string $record has the state name. 
     */
    public function SelectStateName($id)
    {
        $table = self::TABLE_NAME;
        $stmt = $this->dbConnect->prepare("SELECT state_name FROM $table WHERE state_id = ?");
        $stmt->execute([$id]);
        $record = $stmt->fetch();
        return $record['state_name'];
    }
}