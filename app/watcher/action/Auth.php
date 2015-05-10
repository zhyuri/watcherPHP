<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Auth.php
*   description:      权限验证层
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* 权限验证层
*/
class Action_Auth extends Action_Base
{
    function __construct() {}

    public static function run()
    {
        if (ACTION_NAME == 'About') {
            return true;
        }
        session_start();
        $_SESSION['word'] = isset($_SESSION['word']) ? $_SESSION['word'] : '';
        $resource = array();

        if (isset($_GET['word'])) {
            $_SESSION['word'] = $_GET['word'];//带Get参数时以Get里的为准
        }
        if (ACTION_NAME == 'Index') {
            $_SESSION['word'] = '';//返回首页时清空
        } else if (explode('_', ACTION_NAME)[0] != 'Api' && $_SESSION['word'] == '') {
            header("Location: /watcher");//当word为空时跳转至首页
            exit;
        }

        $resource['topic'] = $_SESSION['word'];

        parent::setResource($resource);//页面专用，api以各自参数为准
        return true;
    }
}

?>
