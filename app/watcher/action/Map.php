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

        $view = new Vera_View();
        $template = 'map.tpl';
        $cacheId = md5($word);//中文不能作为cache_id
        $isCached = $view->isCached($template, $cacheId);
        Vera_Log::addNotice('isCached', intval($isCached));
        if ($isCached) {
            $view->display($template, $cacheId);
            return true;
        }
        $result = false;

        $postNum = Service_Topic::getNumOfPost($word);
        $result = $postNum > 0;

        $view->assign('title', '全国传播地图');
        $view->assign('result', $result);//是否获取到了结果

        if ($result) {
            $coordData = Service_Location::getGeoCoord();
            $lineData = Service_Location::getRepostLocByTopic($word);
            $pointData = self::_buildPoint($lineData);

            $view->assign('postNum', $postNum);//转发数
            $view->assign('coordData', $coordData);//全部的Location列表
            $view->assign('lineData', $lineData);//标线数据
            $view->assign('pointData', $pointData);//标点数据
            $view->setCacheLifetime(86400);
        } else {
            $this->caching = Smarty::CACHING_OFF;
        }
        $view->display($template, $cacheId);
        return true;
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
