<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Topic.php
*   description:      添加话题收录接口
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

class Action_Api_Topic extends Action_Base
{
    function __construct() {}

    public function run()
    {
        if (!isset($_GET['word']) || empty($_GET['word'])) {
            $ret = array('errno' => 1, 'errmsg' => '参数错误');
            echo json_encode($ret, JSON_UNESCAPED_UNICODE);
            return false;
        }

        $word = $_GET['word'];
        $result = Data_Topic::add($word);
        if (!$result) {
            $ret = array('errno' => 2, 'errmsg' => '话题已被收录');
            echo json_encode($ret, JSON_UNESCAPED_UNICODE);
            return false;
        }
        $ret = array('errno' => 0, 'errmsg' => 'OK');
        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
        return true;
    }
}

?>
