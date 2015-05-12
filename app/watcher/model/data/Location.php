<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Location.php
*   description:      位置信息获取类
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* x
*/
class Data_Location
{
    function __construct() {}

    public static function get()
    {
        $db = Vera_Database::getInstance();
        return $db->select('location', '*');
    }

    public static function getLocFromId($locID)
    {
        $db = Vera_Database::getInstance();
        $result = $db->select('location', '*', array('id' => $locID));
        return isset($result[0]) ? $result[0] : array();
    }
}
?>
