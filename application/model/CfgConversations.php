<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/12/2019
 * Time: 11:59 PM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/DatabaseConnection.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/Constants.php');

class CfgConversations
{
    /**
     * Method to fetch all the active conversations of a user by uid.
     * @param $uid
     * @return bool|mysqli_result
     */
    public function fetchChatsByUID($uid)
    {
        // db connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // query to fetch all the chats related to this user.
        $fetchChatsByUidQuery = "SELECT * FROM cfgconversations WHERE '$uid' IN (FromUID , ToUID) AND Active = ".Constants::ACTIVE;

        // run the sql query to fetch all chats.
        $arrCfgConversation = $dbConnection->query($fetchChatsByUidQuery);

        // check if the query result has more than 1 item.
        if($arrCfgConversation->num_rows > 0)
        {
            return $arrCfgConversation;
        }
        return false;
    }

    public function fetchConversationByUsers($userUId, $chatUID)
    {
        // db connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // query to fetch all the chats related to this user.
        $fetchConversationQuery = "SELECT * FROM cfgconversations WHERE '$userUId' IN (FromUID , ToUID) AND '$chatUID' IN (FromUID, ToUID) AND Active = ".Constants::ACTIVE;

        // run the sql query to fetch all chats.
        $objCfgConversation = $dbConnection->query($fetchConversationQuery);

        // check if the query result has more than 1 item.
        if($objCfgConversation->num_rows > 0)
        {
            return $objCfgConversation->fetch_assoc();
        }
        return false;
    }

    public function saveConversation($fromUID, $toUID)
    {
        // db connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // query to fetch all the chats related to this user.
        $insertConversationQuery = "INSERT INTO cfgconversations (FromUID, ToUID) VALUES ('$fromUID', '$toUID')";

        // run the sql query to fetch all chats.
        $objCfgConversation = $dbConnection->query($insertConversationQuery);

        // check if the query result has more than 1 item.
        if($objCfgConversation)
        {
            return $objCfgConversation;
        }
        return false;
    }
}