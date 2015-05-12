<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Map.php
*   description:      传播地图
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

class Action_Map extends Action_Base
{

    function __construct() {}

    public function run()
    {
        $resource = parent::getResource();
        $word = $resource['topic'];
        $result = false;

        $coordData = Service_Location::getGeoCoord();
        $lineData = Service_Location::getRepostLocByTopic($word);
        $pointData = self::_buildPoint($lineData);

        $postNum = Service_Topic::getNumOfPost($word);
        if ($postNum > 0) {
            $result = true;
        }

        $view = new Vera_View(true);
        $view->assign('title', '全国传播地图');
        $view->assign('result', $result);//是否获取到了结果
        $view->assign('postNum', $postNum);//转发数
        $view->assign('coordData', json_encode($coordData, JSON_UNESCAPED_UNICODE));//全部的Location列表
        $view->assign('pointData', json_encode($pointData, JSON_UNESCAPED_UNICODE));//标点数据
        $view->assign('lineData', json_encode($lineData, JSON_UNESCAPED_UNICODE));//标线数据

        $view->display('extends:layout/main.tpl|map.tpl');
    }

    private static function _buildPoint($line)
    {
        $temp = array();
        foreach ($line as $each) {
            if (isset($temp[$each[0]['name']])) {
                $temp[$each[0]['name']]+=1;
                continue;
            }
            if (isset($temp[$each[1]['name']])) {
                $temp[$each[1]['name']]+=1;
                continue;
            }
            $temp[$each[0]['name']] = 1;
            $temp[$each[1]['name']] = 1;
        }

        $ret = array();
        foreach ($temp as $key => $value) {
            array_push($ret, array('name' => $key, 'value' => $value));
        }
        return $ret;
    }
}

?>
