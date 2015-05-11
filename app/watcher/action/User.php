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
    const NODE_MIN_SIZE = 0.1;//设置节点门槛
    const NODE_MAX_SIZE = 100;
    const LINK_MIM_WIDTH = 1;
    const LINK_MAX_WIDTH = 7;

    private static $_nodeTpl = array(
        'name' => '',
        'label' => '',
        'value' => 0,
        'ignore' => false,
        'symbol' => 'circle',
        'symbolSize' => 10,
        'category' => 0,
        'itemStyle' => array(
            'normal' => array(
                'color' => ''
            )
        )
    );

    private static $_linkTpl = array(
        'source' => '',
        'target' => '',
        'weight' => 1,
        'itemStyle' => array(
            'normal' => array(
                'type' => 'line',
                'color' => 'teal',
                'width' => 2
                )
        )
    );

    function __construct() {}

    public function run()
    {
        $resource = parent::getResource();
        $word = $resource['topic'];

        $nodes = array();
        $users = Service_Topic::getUsersWithRepost($word);
        $sum = Service_Topic::getNumOfPost($word);
        foreach ($users as $user) {
            $node = self::_buildNode($user, $sum);
            if (!empty($node)) array_push($nodes, $node);
        }

        $links = self::_buildLink($nodes, $sum);

        $userNum = Service_User::getNumOfTopic($word);

        $view = new Vera_View(true);
        $view->assign('title', '用户传播拓扑');
        $view->assign('result', !empty($nodes));//是否获取到了结果
        $view->assign('nodes', $nodes);//用户
        $view->assign('links', $links);//转发关系
        $view->assign('userNum', $userNum);//参与用户数
        $view->display('extends:layout/main.tpl|user.tpl');
    }

    private static function _buildNode($user, $sum)
    {
        // 算出节点大小
        $size = $user['repost'] / $sum * self::NODE_MAX_SIZE;
        if ($size <= self::NODE_MIN_SIZE) {
            return array();
        }
        $node = self::$_nodeTpl;
        $node['name'] = $user['id'];
        $node['label'] = $user['name'];
        $node['value'] = $user['repost'];
        $node['category'] = $user['type'];
        $node['symbolSize'] = $size;
        return $node;
    }

    private static function _buildLink($nodes, $sum)
    {
        $ret = array();
        foreach ($nodes as $from) {
            foreach ($nodes as $to) {
                $fromId = $from['name'];
                $toId = $to['name'];
                if ($fromId == $toId) continue;
                $post = Data_Post::findLinkBetween($fromId, $toId);
                if (empty($post)) continue;
                $link = self::$_linkTpl;
                $link['source'] = $fromId;
                $link['target'] = $toId;
                $link['weight'] = $from['value'];
                $width = ($from['value'] + $to['value']) / $sum * self::LINK_MAX_WIDTH;
                $link['itemStyle']['normal']['width'] = $width < self::LINK_MIM_WIDTH ? self::LINK_MIM_WIDTH : $width;
                if ($width >= 0.5 * self::LINK_MAX_WIDTH) {//超过半数转发标红
                    $link['itemStyle']['normal']['color'] = 'red';
                }
                array_push($ret, $link);
            }
        }
        return $ret;
    }

}

?>
