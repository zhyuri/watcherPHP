<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Mood.php
*   description:      情绪数据获取接口
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

class Action_Api_Mood extends Action_Base
{
    function __construct() {}

    public function run()
    {
        if (!isset($_GET['user']) || $_GET['user'] == '') {
            return self::_country();
        }
        return self::_user($_GET['user']);
    }

    private static function _country()
    {
        $result = Service_Mood::getCountry();
        $ret = array('errno'=> 0, 'errmsg' => 'OK', 'data' => $result ? $result : '');
        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
        return true;
    }

    private static function _user($user)
    {
        $result = Service_Mood::getUser($user);
        $ret = array('errno'=> 0, 'errmsg' => 'OK', 'data' => $result ? $result : '');
        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
        return true;
    }
}
?>
