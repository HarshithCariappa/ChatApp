<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/13/2019
 * Time: 12:00 AM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/DatabaseConnection.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/Constants.php');

class MsYear
{
    /**
     * Method to fetch all the Active Years.
     * @return bool|mysqli_result
     */
    public function fetchAllYear()
    {
        // database connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // Query to fetch all active years.
        $fetchAllGenderSQL = "SELECT * FROM msyear WHERE Active = ".Constants::ACTIVE;

        // run the sql query to fetch all branches.
        $objMSGender = $dbConnection->query($fetchAllGenderSQL);

        // check if the query result has at least 1 row.
        if($objMSGender->num_rows > 0)
        {
            return $objMSGender;
        }

        return false;
    }
}