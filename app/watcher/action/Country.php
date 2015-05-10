<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Country.php
*   description:      情绪趋势图
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

class Action_Country extends Action_Base
{

    function __construct() {}

    public function run()
    {
        $resource = parent::getResource();
        $word = $resource['topic'];

        $dataTpl = array(
            'name' => '',
            'type' => 'map',
            'mapValueCalculation' => 'average',
            'data' => array()
        );

        $posts = Service_Topic::getPostsOfTopic($word);
        $dataList = array();
        $labels = array(date('Y-m-d' ,strtotime($posts[0]['time'])));
        $data = array();
        $day = date('d' ,strtotime($posts[0]['time']));
        foreach ($posts as $post) {
            $postDay = date('d' ,strtotime($post['time']));
            if ($postDay != $day) {
                $day = $postDay;
                $label = date('Y-m-d' ,strtotime($post['time']));
                array_push($labels, $label);
                $dataTpl['name'] = $label;
                $dataTpl['data'] = $data;
                array_push($dataList, $dataTpl);
                $data = array();
            }
            array_push($data, array('name' => $post['location'], 'value' => $post['mood']));
        }

        $view = new Vera_View(true);
        $view->assign('title', '全国情绪趋势');
        $view->assign('labels', implode("','", $labels));//时间轴标签
        $view->assign('data', json_encode($dataList, JSON_UNESCAPED_UNICODE));//数据
        $view->display('extends:layout/main.tpl|country.tpl');
    }
}

?>
