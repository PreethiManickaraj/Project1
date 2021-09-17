<?php 

/**
 *  CountryData model class used to perform operations in Country table
 *  @var object $dbConnect is object for dbConnect class.
 *  @var string TABLE_NAME is a constant contains table name.
 */
class CountryData
{
    const TABLE_NAME = 'country';
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
     *  Method for selecting all the countries name from table.
     *  @var string $table has the country table
     *  @return array return all countries from country table.
     */
    public function selectCountry()
    {
        $table = self::TABLE_NAME;
        return $this->dbConnect->query("SELECT * FROM $table ORDER BY id asc");
    }
}