<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/12/2019
 * Time: 11:59 PM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/DatabaseConnection.php');

class MsGender
{
    /**
     * Method to fetch all active gender data.
     * @return bool|mysqli_result
     */
    public function fetchAllGender()
    {
        // database connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // Query to fetch all the gender data.
        $fetchAllGenderSQL = "SELECT * FROM msgender";

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