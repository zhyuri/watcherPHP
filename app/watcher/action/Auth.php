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
        $resource = array();
        session_start();

        if (ACTION_NAME == 'Index') {
            $_SESSION['topic'] = '';
        }

        if (isset($_GET['topic']) && !empty($_GET['topic']) && $_GET['topic'] != $_SESSION['topic']) {
            $_SESSION['topic'] = $_GET['topic'];
        }
        $resource['topic'] = $_SESSION['topic'];

        parent::setResource($resource);
        return true;
    }
}

?>
