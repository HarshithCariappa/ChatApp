<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/12/2019
 * Time: 11:58 PM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/DatabaseConnection.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/Constants.php');


class AppUser
{
    /**
     * Method to fetch the users by usn and password
     * If user do not exists or is inactive send false, else send the user object.
     * @param $usn
     * @param $password
     * @return array|bool
     */
    public function getUser($usn, $password)
    {
        // db connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // encrypt password.
        $encryptedPassword = md5($password);

        // sql to fetch the user.
        $getUserSql = "SELECT * FROM appuser WHERE USN = '$usn' and password = '$encryptedPassword' and Active = ".Constants::ACTIVE;

        // run the sql query to fetch the user.
        $objAppuser = $dbConnection->query($getUserSql);

        // check if the user exists, If yes then return the user information, else return null.
        if($objAppuser){
            return $objAppuser->fetch_assoc();
        }

        return false;
    }

    /**
     * Methdo to register the user.
     * First check if the usn is already taken, If yes then return false, else register.
     * @param $usn
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $branchId
     * @param $password
     * @param $genderID
     * @param $yearID
     * @return bool|mysqli_result
     */
    public function registerUser($usn, $firstName, $lastName, $email, $branchId, $password, $genderID, $yearID)
    {
        // database connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // check if the user already exists.
        $result = $this->checkUserAlreadyExists($usn);

        // if true , it means users exists so return false, indicating this user already exists.
        if($result == true)
        {
            return false;
        }

        // encrypt the password.
        $encryptedPassword = md5($password);

        // sql to insert user.
        $insertUserSql = "INSERT INTO appuser (FirstName, LastName, USN, Email, GenderID, BranchId, YearId, Password, Online) VALUES ('$firstName', '$lastName', '$usn', '$email', '$genderID', '$branchId', '$yearID', '$encryptedPassword', '1')";

        // run the insert query to add this user into the database.
        return $dbConnection->query($insertUserSql);
    }

    /**
     * Method to check if the usn already exists in the system and its active.
     * @param $usn
     * @return bool
     */
    public function checkUserAlreadyExists($usn)
    {
        // database connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // query to fetch user by usn.
        $fetchByUSNSql = "SELECT * FROM appuser WHERE USN = '$usn' AND Active = ".Constants::ACTIVE;

        // run the query to fetch the user object by usn.
        $objAppuser = $dbConnection->query($fetchByUSNSql);

        if($objAppuser->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * This method fetches the user by UID.
     * @param $uid
     * @return array|bool
     */
    public function fetchUserByUID($uid)
    {
        // database connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // query to fetch user by usn.
        $fetchByUSNSql = "SELECT * FROM appuser WHERE UID = '$uid' AND Active = ".Constants::ACTIVE;

        // run the query to fetch the user object by usn.
        $objAppuser = $dbConnection->query($fetchByUSNSql);

        if($objAppuser)
        {
            return $objAppuser->fetch_assoc();
        }else{
            return false;
        }
    }

    /**
     * Method to fetch the data by yearId and BranchId.
     * fetch all except the user data
     * @param $branchID
     * @param $yearID
     * @return array|bool
     */
    public function fetchByBranchIdYearId($branchID, $yearID, $uid)
    {
        // database connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // query to fetch user by usn.
        $fetchByBranchAndYearSql = "SELECT * FROM appuser WHERE BranchId = '$branchID' AND YearID = '$yearID' AND UID != '$uid' AND Active = ".Constants::ACTIVE." ORDER BY FirstName ";

        // run the query to fetch the user object by usn.
        $objAppuser = $dbConnection->query($fetchByBranchAndYearSql);

        if($objAppuser->num_rows > 0)
        {
            return $objAppuser;
        }else{
            return false;
        }
    }
}