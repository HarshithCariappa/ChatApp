<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/18/2019
 * Time: 11:31 PM
 */

require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/CfgConversations.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/chatapp/application/model/AppUser.php');

class ChatsController
{
    public function fetchAllConversations($uid)
    {
        $objCfgConversations = new CfgConversations();
        $arrConversations = $objCfgConversations->fetchChatsByUID($uid);

        $arrChats = array();

        if(!$arrConversations)
        {
            return $arrChats;
        }

        while( $cfgConversation = $arrConversations->fetch_assoc() ){

            $objAppUserClass = new AppUser();
            if($cfgConversation['FromUID'] !== $uid)
            {
                $fetchUid = $cfgConversation['FromUID'];
            }else{
                $fetchUid = $cfgConversation['ToUID'];
            }

            // fetch the user by UID. And check if the the user is found, If yes push it to array.
            $objAppUser = $objAppUserClass->fetchUserByUID($fetchUid);
            if($objAppUser)
            {
                array_push($arrChats, $objAppUser);
            }
        }

        return $arrChats;
    }
}