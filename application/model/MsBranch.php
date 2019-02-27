<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/12/2019
 * Time: 11:59 PM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/DatabaseConnection.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/Constants.php');

class MsBranch
{
    /**
     * Method to fetch all active branches.
     * @return bool|mysqli_result
     */
    public function fetchAllBranches()
    {
        // database connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // query to fetch all active branches.
        $fetchAllBranchesSQL = "SELECT * FROM msbranch WHERE Active = ".Constants::ACTIVE;

        // run the sql query to fetch all branches.
        $objMSBranch = $dbConnection->query($fetchAllBranchesSQL);

        // check if the query result has at least 1 row.
        if($objMSBranch->num_rows > 0)
        {
            return $objMSBranch;
        }

        return false;
    }

    /**
     * Method to fetch branch by BranchId.
     * @param $branchId
     * @return bool|mysqli_result
     */
    public function fetchByBranchId($branchId)
    {
        // database connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // Query to fetch branch data by branch Id.
        $fetchByBranchIdSql = "SELECT * FROM msbranch WHERE branchId = $branchId";

        // run the sql query to fetch all branches.
        $objMSBranch = $dbConnection->query($fetchByBranchIdSql);

        // check if the query result has at least 1 row.
        if($objMSBranch && $objMSBranch->num_rows > 0)
        {
            return $objMSBranch->fetch_assoc();
        }

        return false;
    }
}