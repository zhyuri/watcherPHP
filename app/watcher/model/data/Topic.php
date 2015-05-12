<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Topic.php
*   description:      话题表Data层
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* c
*/
class Data_Topic
{
    function __construct() {}

    public static function get($topic)
    {
        $db = Vera_Database::getInstance();
        $result = $db->select('topic', '*', array('content' => $topic, 'is_collect' => 1));
        return isset($result[0]) ? $result[0] : array();
    }

    public static function add($topic)
    {
        $db = Vera_Database::getInstance();
        return $db->insert('topic', array('content' => $topic));
    }
}
?>
