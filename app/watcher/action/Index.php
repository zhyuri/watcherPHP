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
        $hotTopic = array('毕业设计','海韵','凤凰树','毕业季','智能科学与技术','厦门大学','海韵','凤凰树','毕业季','智能科学与技术');
        $view->assign('hotTopic', $hotTopic);
        $view->display('extends:layout/main.tpl|index.tpl');
    }
}

?>
