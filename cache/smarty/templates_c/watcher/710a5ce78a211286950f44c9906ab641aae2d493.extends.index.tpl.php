<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-09 18:02:58
         compiled from "/Users/zhangyuri/站点/templates/watcher/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1663949819554d79725c1259-09922721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ba976c56e9979746c8b9e61ea54cd05938a206f' => 
    array (
      0 => '/Users/zhangyuri/站点/templates/watcher/index.tpl',
      1 => 1431165778,
      2 => 'file',
    ),
    '418ca0cdb5395caaf4c3a97b14af2205ffb5641e' => 
    array (
      0 => '/Users/zhangyuri/站点/templates/watcher/layout/main.tpl',
      1 => 1431162238,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1663949819554d79725c1259-09922721',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_554d797260ae54_20031009',
  'variables' => 
  array (
    'title' => 0,
    'base' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554d797260ae54_20031009')) {function content_554d797260ae54_20031009($_smarty_tpl) {?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? '守望者舆情监控系统' : $tmp);?>
</title>
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
watcher/static/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
watcher/static/css/main.css">

    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
watcher/static/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
watcher/static/js/echarts/echarts.js"><?php echo '</script'; ?>
>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/" tabindex="-1">守望者</a>
        </div>

        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/watcher/country" tabindex="-1">情绪趋势</a></li>
            <li><a href="/watcher/user" tabindex="-1">传播用户</a></li>
            <li><a href="/watcher/map" tabindex="-1">传播地图</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="navbar-form" role="search">
              <div class="input-group">
                <input id="searchInput" type="text" class="form-control nav-item-dark" placeholder="Search" tabindex="1">
                <span class="input-group-btn">
                  <button id="searchButton" class="btn btn-default nav-item-dark" tabindex="-1">搜索</button>
                </span>
              </div>
            </li>
            <li><a href="/about" tabindex="-1">关于</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>

    
<?php echo '<script'; ?>
 type="text/javascript">
    $("ul.navbar-right li[role='search']").html('');//清除导航栏中原本的搜索框
<?php echo '</script'; ?>
>
<div class="row text-center head-title">
    <h1>守望者舆情监控系统&nbsp<small>Beta</small></h1>
    <p>Yuri</p>
</div>

<div class="row center-block" style="width: 40%;height: 50px;">
    <form class="input-group" action="/watcher/country" method="post">
      <input name="topic" type="text" class="form-control nav-item-dark" placeholder="Search" tabindex="1">
      <span class="input-group-btn">
        <button class="btn btn-default nav-item-dark" tabindex="-1">搜索</button>
      </span>
    </form>
</div>

<div id="wholeCountry" style="height: 550px;"></div>
<?php echo '<script'; ?>
 type="text/javascript">
require.config({
    paths: {
        echarts: '.<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
watcher/static/js/echarts'
    }
});

require(
    [
        'echarts',
        'echarts/chart/map'
    ],
    function(ec) {
        var option = {
            title: {
                text: '',
                subtext: '',
                x: 'center',
                textStyle: {
                    fontSize: 25,
                    fontWeight: 'bolder',
                    color: '#9d9d9d'
                }
            },
            dataRange: {
                show: false,
                min: 0,
                max: 2500,
                x: 1000,
                y: 'center',
                text: ['高', '低'], // 文本，默认为数值文本
                calculable: true,
                color: ['#0af', '#ffffff']
            },
            series: [{
                name: '测试数据',
                type: 'map',
                mapType: 'china',
                hoverable: false,
                dataRangeHoverLink: false,
                mapValueCalculation: 'sum',
                roam: false, //首页概况图禁止缩放
                itemStyle: {
                    normal: {
                        label: {
                            show: true
                        }
                    },
                    emphasis: {
                        label: {
                            show: true
                        }
                    }
                },
                data: [{
                    name: '北京',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '天津',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '上海',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '重庆',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '河北',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '河南',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '云南',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '辽宁',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '黑龙江',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '湖南',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '安徽',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '山东',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '新疆',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '江苏',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '浙江',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '江西',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '湖北',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '广西',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '甘肃',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '山西',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '内蒙古',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '陕西',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '吉林',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '福建',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '贵州',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '广东',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '青海',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '西藏',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '四川',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '宁夏',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '海南',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '台湾',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '香港',
                    value: Math.round(Math.random() * 1000)
                }, {
                    name: '澳门',
                    value: Math.round(Math.random() * 1000)
                }]
            }]
        };

        var chart = ec.init(document.getElementById('wholeCountry'));
        chart.setOption(option);
    });
<?php echo '</script'; ?>
>


</div>

<footer class="stick-bottom">
  <div class="container">
    <p class="text-center">Designed and built with all the love in the world by <a href="mailto:zhang1437@gmail.com" tabindex="-1">Yuri</a> at <a href="http://www.xmu.edu.cn" target="_blank" tabindex="-1">XMU</a></p>
  </div>
</footer>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
watcher/static/js/bootstrap.min.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }} ?>
