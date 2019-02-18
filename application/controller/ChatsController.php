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

        while( $cfgConversation = $arrConversations->fetch_assoc() ){

            $objAppUserClass = new AppUser();
            if($cfgConversation['FromUID'] !== $uid)
            {
                $fetchUid = $cfgConversation['FromUID'];
            }else{
                $fetchUid = $cfgConversation['ToUID'];
            }

            $objAppUser = $objAppUserClass->fetchUserByUID($fetchUid);
            array_push($arrChats, $objAppUser);
        }

        return $arrChats;
    }
}