<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Post.php
*   description:      微博数据Data层
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* x
*/
class Data_Post
{
    function __construct() {}

    public static function getByUser($user)
    {
        $db = Vera_Database::getInstance();
        return $db->select('post', '*', array('owner_id' => $user));
    }

    public static function getSince($time)
    {
        $db = Vera_Database::getInstance();
        return $db->select('post', '*', "time >= '{$time}'");
    }
}
?>
