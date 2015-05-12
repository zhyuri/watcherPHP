<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Topic.php
*   description:      话题信息获取Service层
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* x
*/
class Service_Topic
{
    function __construct() {}

    public static function getHotTopic()
    {
        return array('毕业设计','海韵','凤凰树','毕业季','智能科学与技术','厦门大学','海韵','凤凰树','毕业季','智能科学与技术');
    }

    public static function getUsersWithRepost($topic)
    {
        $info = Data_Topic::get($topic);
        if (empty($info)) {
            return array();
        }
        $users = Data_Post::getUserByTopic($info['id']);
        foreach ($users as &$user) {
            $user = Data_User::getInfo($user['owner_id']);
            $user['repost'] = Data_Post::getCountByTopicSource($info['id'], $user['id']);
        }
        return $users;
    }

    public static function getPosts($topic, $since = '')
    {
        if ($since == '') {
            $since = date("Y-m-d H:i:s",strtotime("last month"));
        }
        $info = Data_Topic::get($topic);
        if (empty($info)) {
            return array();
        }
        $posts = Data_Post::getByTopicSince($info['id'], $since);
        foreach ($posts as &$post) {
            $loc = Service_User::getLoc($post['owner_id']);
            if (isset($loc['first'])) {
                $post['location'] = $loc['first'];
            }
        }
        return $posts;
    }

    public static function getNumOfPost($topic)
    {
        $info = Data_Topic::get($topic);
        if (empty($info)) {
            return 0;
        }
        return Data_Post::getCountByTopic($info['id']);
    }

}
?>
