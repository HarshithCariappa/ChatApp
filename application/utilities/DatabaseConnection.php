<?php
/**
 * Created by PhpStorm.
 * User: Harshith
 * Date: 2/13/2019
 * Time: 12:03 AM
 */

class DatabaseConnection
{
/*    public function __construct(){
        return mysqli_connect('localhost', 'root', '', 'chatapp');
    }*/

    public function getConnection(){
        return mysqli_connect('localhost', 'root', '', 'chatapp');
    }
}