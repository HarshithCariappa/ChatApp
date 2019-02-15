<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/15/2019
 * Time: 9:09 PM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/DatabaseConnection.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/utilities/Constant.php');

class CfgMessages
{
    /**
     * Method to fetch all the active chats by the conversationId.
     * @param $conversationId
     * @return bool|mysqli_result
     */
    public function fetchByConversationId($conversationId)
    {
        // db connection
        $dbConnectorObject = new DatabaseConnection();
        $dbConnection = $dbConnectorObject->getConnection();

        // query to fetch all the chats related to this user.
        $fetchMessagesQuery = "SELECT * FROM cfgmessages WHERE ConversationId = '$conversationId' AND Active = ".Constants::ACTIVE." ORDER BY SentOn";

        // run the sql query to fetch all chats.
        $arrCfgMessages = $dbConnection->query($fetchMessagesQuery);

        // check if the query result has more than 1 item.
        if($arrCfgMessages->num_rows > 0)
        {
            return $arrCfgMessages;
        }
        return false;
    }
}