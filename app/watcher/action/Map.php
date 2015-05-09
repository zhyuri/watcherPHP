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
        $view = new Vera_View(true);
        $view->assign('title', '全国传播地图');
        $view->display('extends:layout/main.tpl|map.tpl');
    }
}

?>
