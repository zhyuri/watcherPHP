<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             User.php
*   description:      用户信息获取类
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

class Data_User
{
    function __construct() {}

    public static function getInfo($user)
    {
        $db = Vera_Database::getInstance();
        $result = $db->select('user', '*', array('id' => $user));
        return isset($result[0]) ? $result[0] : array();
    }
}
?>
