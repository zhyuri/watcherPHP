<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Mood.php
*   description:      情绪数据获取Service层
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
*  c
*/
class Service_Mood
{
    function __construct() {}

    public static function getCountry()
    {
        $since = date("Y-m-d H:i:s",strtotime("last month"));
        $posts = Data_Post::getSince($since);

        $ret = array();
        foreach ($posts as $post) {
            $loc = Service_User::getLoc($post['owner_id']);
            if (empty($loc)) {
                continue;
            }
            if (!isset($ret[$loc[$level]])) {
                $ret[$loc[$level]] = 0;
            }
            $ret[$loc[$level]] = ($ret[$loc[$level]] + $post['mood']) / 2;
        }
        return $ret;
    }
}

?>
