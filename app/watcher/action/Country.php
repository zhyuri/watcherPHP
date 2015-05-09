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
        $view = new Vera_View(true);
        $view->assign('title', '全国情绪趋势');
        $view->display('extends:layout/main.tpl|country.tpl');
    }
}

?>
