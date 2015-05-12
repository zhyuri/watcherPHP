<?php
/**
*
*   @copyright  Copyright (c) 2015 Yuri Zhang (http://blog.yurilab.com)
*   All rights reserved
*
*   file:             build_sql.php
*   description:      生成测试数据
*
*   @author Yuri <zhang1437@gmail.com>
*   @license Apache v2 License
*
**/

function buildLocation()
{
    //位置表录入
    $content = file_get_contents('geo.txt');
    $lines = explode("\n", $content);

    $sql = 'insert into location (first, second, third, longitude, latitude) values ';
    $tpl = "('%s', '%s', '%s', %f, %f),";
    foreach ($lines as $line) {
        $word = explode(' ', $line);
        if (!isset($word[1])) {
            continue;
        }
        $sql.= sprintf($tpl, $word['0'], $word['1'], $word['2'], $word['3'], $word['4']);
    }

    echo $sql;
}

function buildUser()
{
    //用户表构造
    $content = file_get_contents('user.txt');
    $names = explode(',', $content);

    $sql = 'insert into user (name, location) values ';
    $tpl = "('%s', %d),";

    // 100个厦门账户
    for ($i=0; $i < 100; $i++) {
        $sql.= sprintf($tpl, $names[mt_rand(0, 10000)], mt_rand(1181, 1187));
    }

    // 100个福建账户
    for ($i=0; $i < 100; $i++) {
        $sql.= sprintf($tpl, $names[mt_rand(0, 10000)], mt_rand(1167, 1260));
    }

    // 800个全国随机账户
    for ($i=0; $i < 800; $i++) {
        $sql.= sprintf($tpl, $names[mt_rand(0, 10000)], mt_rand(0, 3156));
    }
    echo $sql;
}

function bulidPost()
{
    $sql = 'insert into post (owner_id, content, topic_id, time, mood, source) values ';
    $tpl = "(%d, '%s', %d, '%s', %d, %d),";

    $sql.= "(1, '本科生毕业设计答辩时间通知#毕业设计#', 1, '2015-05-01 00:00:00', 0, 0),";
    $sql.= "(2, '要答辩咯~！#毕业设计#', 1, '2015-05-01 00:00:01', 0, 1),";
    $sql.= "(3, '嘉庚的同学看过来#毕业设计#', 1, '2015-05-01 00:00:01', 0, 1),";
    $sql.= "(4, '完蛋了什么都没做！！！要死要死要死。。。#毕业设计#', 1, '2015-05-01 00:00:02', 0, 1),";

    // 从原博转发200条
    for ($i=0; $i < 200; $i++) {
        $sql.= sprintf($tpl, mt_rand(0, 1004), '转发微博', 1, _randomDate('2015-05-01 08:00:00', '2015-05-10 00:00:00'), mt_rand(-100, 100), 1);
    }
    // 从蓝V转发200条
    for ($i=0; $i < 200; $i++) {
        $sql.= sprintf($tpl, mt_rand(0, 1004), '转发微博', 1, _randomDate('2015-05-01 08:00:00', '2015-05-10 00:00:00'), mt_rand(-100, 100), mt_rand(2, 3));
    }
    // 从黄V转发800条
    for ($i=0; $i < 800; $i++) {
        $sql.= sprintf($tpl, mt_rand(0, 1004), '转发微博', 1, _randomDate('2015-05-01 08:00:00', '2015-05-10 00:00:00'), mt_rand(-100, 100), 4);
    }
    // 随机转发800条
    for ($i=0; $i < 800; $i++) {
        $sql.= sprintf($tpl, mt_rand(0, 1004), '转发微博', 1, _randomDate('2015-05-01 08:00:00', '2015-05-10 00:00:00'), mt_rand(-100, 100), mt_rand(0, 1004));
    }

    echo $sql;
}

/**
 *   生成某个范围内的随机时间
 * @param <type> $begintime  起始时间 格式为 Y-m-d H:i:s
 * @param <type> $endtime    结束时间 格式为 Y-m-d H:i:s
 */
function _randomDate($begintime, $endtime="") {
    $begin = strtotime($begintime);
    $end = $endtime == "" ? mktime() : strtotime($endtime);
    $timestamp = rand($begin, $end);
    return date("Y-m-d H:i:s", $timestamp);
}

$valid_arg = array('-l', '-u', '-p');
if (!isset($argv[1]) || !in_array($argv[1], $valid_arg)) {
    echo "使用方法:\n";
    echo "-l\t生成location表测试数据\n";
    echo "-u\t生成user表测试数据\n";
    echo "-p\t生成post表测试数据\n";
    return true;
}
switch ($argv[1]) {
    case '-l':
        buildLocation();
        break;
    case '-u':
        buildUser();
        break;
    case '-p':
        bulidPost();
        break;
}

?>
