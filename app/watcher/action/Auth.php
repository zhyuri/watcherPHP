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
        session_start();
        $resource = array();

        if (isset($_GET['word'])) {
            $_SESSION['topic'] = $_GET['word'];//带Get参数时以Get里的为准
        }
        if (ACTION_NAME == 'Index') {
            $_SESSION['topic'] = '';//返回首页时清空
        } else if ($_SESSION['topic'] == '' && explode('_', ACTION_NAME)[0] != 'Api') {
            //当topic为空时跳转至首页
            header("Location: /watcher");
            exit;
        }

        $resource['topic'] = $_SESSION['topic'];

        parent::setResource($resource);
        return true;
    }
}


// 有$_GET['word']用这个
// 没有的话为空，并且跳转到首页

?>
