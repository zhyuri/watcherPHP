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
    private static $_seriesTpl = array(
        'name' => '',
        'type' => 'map',
        'roam' => true,
        'mapValueCalculation' => 'average',
        'clickable' => false,
        'scaleLimit' => array(//放缩界限
            'max'=> 2,
            'min'=> 1
        ),
        'data' => array()
    );

    function __construct() {}

    public function run()
    {
        $resource = parent::getResource();
        $word = $resource['topic'];

        $view = new Vera_View();
        $template = 'country.tpl';
        $cacheId = md5($word);//中文不能作为cache_id
        $isCached = $view->isCached($template, $cacheId);
        Vera_Log::addNotice('isCached', intval($isCached));
        if ($isCached) {
            $view->display($template, $cacheId);
            return true;
        }
        $result = false;

        $list = self::_getDataAndLabel($word);
        $result = $list['result'];
        $view->assign('title', '舆情趋势');
        $view->assign('result', $result);//是否获取到了结果

        if ($result) {
            $postNum = Service_Topic::getNumOfPost($word);
            $userNum = Service_User::getNumOfTopic($word);
            $view->assign('postNum', $postNum);//转发数
            $view->assign('userNum', $userNum);//参与用户
            $view->assign('labels', implode("','", $list['labels']));//时间轴标签
            $view->assign('data', $list['data']);//数据
            $view->setCacheLifetime(86400);
        } else {
            $this->caching = Smarty::CACHING_OFF;
        }
        $view->display($template, $cacheId);
        return true;
    }

    private function _getDataAndLabel($word)
    {

        $posts = Service_Topic::getPosts($word);
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
                self::$_seriesTpl['data'] = $data;
                array_push($dataList, self::$_seriesTpl);
                $data = array();
            }
            array_push($data, array('name' => $post['location'], 'value' => $post['mood']));
        }
        self::$_seriesTpl['data'] = $data;
        array_push($dataList, self::$_seriesTpl);

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
