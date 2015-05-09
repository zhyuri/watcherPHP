<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Base.php
*   description:      守望者舆情监控基类
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* action基类
*/
class Action_Base
{
    private static $resource = NULL;

    function __construct() {}

    protected static function getResource()
    {
        return self::$resource;
    }

    protected static function setResource($_resource)
    {
        if(empty($_resource))
            return false;
        self::$resource = $_resource;
    }
}
?>
