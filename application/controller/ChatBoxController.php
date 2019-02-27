<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/25/2019
 * Time: 11:00 PM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/CfgConversations.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/CfgMessages.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/controller/PageRedirector.php');

if(!isset($_SESSION))
{
    session_start();
}

if(isset($_POST['message'])){
    $objChatBoxControllerClass = new ChatBoxController();
    $objChatBoxControllerClass->saveChatMessages($_POST['message'], $_SESSION['ConversationId'], $_SESSION['UID']);
}

class ChatBoxController
{
    public function fetchMessagesByUsers($userUID, $chatUID)
    {
        $objCfgConversationClass = new CfgConversations();
        $objCfgConversation =  $objCfgConversationClass->fetchConversationByUsers($userUID, $chatUID);

        if(!$objCfgConversation)
        {
            $objCfgConversation = $objCfgConversationClass->saveConversation($userUID, $chatUID);
        }

        $_SESSION['ConversationId'] = $objCfgConversation['ConversationID'];

        $objCfgMessageClass = new CfgMessages();
        $arrCfgMessages = $objCfgMessageClass->fetchByConversationId($objCfgConversation['ConversationID']);

        return $arrCfgMessages;
    }

    public function saveChatMessages($message, $conversationId, $senderUID)
    {
        $objCfgMessagesClass = new CfgMessages();
        $objCfgMessagesClass->saveChatMessage($conversationId, $senderUID, $message);

        $objPageRedirectorClass = new PageRedirector();
        $objPageRedirectorClass->redirectToChatBox($_SESSION['chatUID']);
    }
}