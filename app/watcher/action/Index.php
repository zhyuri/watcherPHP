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
        $view = new Vera_View();
        $template = 'extends:layout/main.tpl|index.tpl';

        if (!$view->isCached($template)) {
            $hotTopic = Service_Topic::getHotTopic();
            $view->assign('hotTopic', $hotTopic);
            $view->setCacheLifetime(3600);//首页过期时间一小时
        } else {
            Vera_Log::addNotice('isCached', 1);
        }
        $view->display($template);
    }
}

?>
