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

    public static function getSince($time)
    {
        $db = Vera_Database::getInstance();
        return $db->select('post', '*', "time >= '{$time}'");
    }

    public static function getByUser($user)
    {
        $db = Vera_Database::getInstance();
        return $db->select('post', '*', array('owner_id' => $user));
    }

    public static function getByTopic($topic)
    {
        $db = Vera_Database::getInstance();
        return $db->select('post', '*', array('topic_id' => $topic));
    }

    public static function getByTopicSince($topic, $time)
    {
        $db = Vera_Database::getInstance();
        return $db->select('post', '*', "topic_id = {$topic} and time >= '{$time}'", NULL, 'order by time');
    }

    public static function getCountByTopic($topic)
    {
        $db = Vera_Database::getInstance();
        return $db->selectCount('post', array('topic_id' => $topic));
    }

    public static function getUserCountByTopic($topic)
    {
        $db = Vera_Database::getInstance();
        $result = $db->select('post', 'owner_id', array('topic_id' => $topic), 'DISTINCT');
        return count($result);
    }
}
?>
