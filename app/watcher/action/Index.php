<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Index.php
*   description:      守望者首页
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* 首页Action
*/
class Action_Index extends Action_Base
{

    function __construct() {}

    public function run()
    {
        $view = new Vera_View(true);
        // $view->assign('title', '守望者舆情监控系统');
        $view->display('extends:layout/main.tpl|index.tpl');
    }
}

?>
