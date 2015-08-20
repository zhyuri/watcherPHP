<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             Fix.php
*   description:      修复数据库
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

/**
* x
*/
class Action_Api_Fix extends Action_Base
{
    function __construct() {}

    public function run()
    {
        $db = Vera_Database::getInstance();
        for ($i=1; $i < 2005; $i++) {
            $old = $db->select('post', 'time', array('id' => $i));
            $newTime = strtotime($old[0]['time'].' +1 month');
            var_dump($newTime);
            $update = array('time' => date("Y-m-d H:i:s", $newTime));
            $db->update('post', $update, array('id' =>$i));
        }
    }
}

?>
