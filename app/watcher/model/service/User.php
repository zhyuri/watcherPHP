<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             User.php
*   description:      用户信息获取Service层
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* x
*/
class Service_User
{
    function __construct() {}

    public static function getLoc($user)
    {
        $info = Data_User::getInfo($user);
        if (empty($info)) {
            return array();
        }
        return Data_Location::getLocFromId($info['location']);
    }

    public static function getNumOfTopic($topic)
    {
        $info = Data_Topic::get($topic);
        if (empty($info)) {
            return 0;
        }
        return Data_Post::getUserCountByTopic($info['id']);
    }
}
?>
