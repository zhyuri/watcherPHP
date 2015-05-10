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
        # code...
    }

    public static function getPostsOfTopic($topic, $since = '')
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

}
?>
