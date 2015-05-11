<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             User.php
*   description:      用户传播
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

class Action_User extends Action_Base
{

    function __construct() {}

    public function run()
    {
        $resource = parent::getResource();
        $word = $resource['topic'];

        $postNum = Service_Topic::getNumOfPost($word);
        $userNum = Service_User::getNumOfTopic($word);


        $view = new Vera_View(true);
        $view->assign('title', '用户传播拓扑');
        $view->assign('postNum', $postNum);//转发数
        $view->assign('userNum', $userNum);//参与用户
        $view->display('extends:layout/main.tpl|user.tpl');
    }
}

?>
