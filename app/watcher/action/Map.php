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

        $postNum = Service_Topic::getNumOfPost($word);

        $view = new Vera_View(true);
        $view->assign('title', '全国传播地图');
        $view->assign('result', true);//是否获取到了结果
        $view->assign('postNum', $postNum);//转发数
        $view->display('extends:layout/main.tpl|map.tpl');
    }
}

?>
