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

        $list = self::_getDataAndLabel($word);
        $postNum = Service_Topic::getNumOfPost($word);
        $userNum = Service_User::getNumOfTopic($word);

        $view = new Vera_View(true);
        $view->assign('title', '舆情趋势');
        $view->assign('result', $list['result']);//是否获取到了结果
        $view->assign('postNum', $postNum);//转发数
        $view->assign('userNum', $userNum);//参与用户
        $view->assign('labels', implode("','", $list['labels']));//时间轴标签
        $view->assign('data', json_encode($list['data'], JSON_UNESCAPED_UNICODE));//数据
        $view->display('extends:layout/main.tpl|country.tpl');
    }

    private function _getDataAndLabel($word)
    {
        $dataTpl = array(
            'name' => '',
            'type' => 'map',
            'roam' => true,
            'mapValueCalculation' => 'average',
            'data' => array()
        );

        $posts = Service_Topic::getPostsOfTopic($word);
        if (empty($posts)) {
            return array('result' => false, 'data' => array(), 'labels' => array());
        }

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
                $dataTpl['data'] = $data;
                array_push($dataList, $dataTpl);
                $data = array();
            }
            array_push($data, array('name' => $post['location'], 'value' => $post['mood']));
        }
        $dataTpl['data'] = $data;
        array_push($dataList, $dataTpl);

        $i = 0;
        foreach ($dataList as &$each) {
            $temp = array();
            foreach ($each['data'] as $value) {
                if (!isset($temp[$value['name']])) {
                    $temp[$value['name']] = $value['value'];
                } else {
                    $temp[$value['name']] = ($temp[$value['name']] + $value['value']) / 2;
                }
            }
            $tempData = array();
            foreach ($temp as $key => $value) {
                array_push($tempData, array('name' => $key, 'value' => $value));
            }
            $each['name'] = $labels[$i];
            $each['data'] = $tempData;
            $i++;
        }

        return array('result' => true, 'data' => $dataList, 'labels' => $labels);
    }
}

?>
