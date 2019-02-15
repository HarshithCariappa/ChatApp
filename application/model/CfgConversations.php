<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/12/2019
 * Time: 11:59 PM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/DatabaseConnection.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/Constant.php');

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
}