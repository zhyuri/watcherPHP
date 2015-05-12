<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             About.php
*   description:      关于页面
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

class Action_About extends Action_Base
{
    function __construct() {}

    public function run()
    {
        $view = new Vera_View(true);
        $view->display('extends:layout/main.tpl|about.tpl');
    }
}

?>
