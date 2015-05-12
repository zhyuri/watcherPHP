<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Location.php
*   description:      位置信息获取Service
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* x
*/
class Service_Location
{
    function __construct() {}

    public static function getGeoCoord()
    {
        // {"北京":[116.46,39.92]}
        $ret = array();
        $list = Data_Location::get();
        foreach ($list as $each) {
            $ret[$each['third']] = array((float)$each['longitude'], (float)$each['latitude']);
        }
        return $ret;
    }

    public static function getRepostLocByTopic($topic)
    {
        $ret = array();
        $posts = Service_Topic::getPosts($topic);
        foreach ($posts as $post) {
            if ($post['source'] == 0 || $post['source'] == $post['owner_id']) {
                continue;//排除原作者与自己转发自己
            }
            $fromLoc = Service_User::getLoc($post['source']);
            $toLoc = Service_User::getLoc($post['owner_id']);
            if ($fromLoc['third'] == $toLoc['third']) {
                continue;//本地转发不算在内
            }
            array_push($ret, array(
                array(
                    'name' => $fromLoc['third'],
                    'value' => intval($post['mood'])
                ),
                array(
                    'name' => $toLoc['third']
                )
            ));
        }
        return $ret;
    }
}
?>
