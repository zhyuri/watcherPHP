<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-10 00:25:30
         compiled from "/Users/zhangyuri/站点/templates/watcher/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1663949819554d79725c1259-09922721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ba976c56e9979746c8b9e61ea54cd05938a206f' => 
    array (
      0 => '/Users/zhangyuri/站点/templates/watcher/index.tpl',
      1 => 1431188729,
      2 => 'file',
    ),
    '418ca0cdb5395caaf4c3a97b14af2205ffb5641e' => 
    array (
      0 => '/Users/zhangyuri/站点/templates/watcher/layout/main.tpl',
      1 => 1431188639,
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
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
            <li role="about"><a href="/about" tabindex="-1">关于</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>

    
<?php echo '<script'; ?>
 type="text/javascript">
    $("ul.navbar-nav li[role!='about']").html('');
    // $("ul.navbar-right li[role='search']").html('');
<?php echo '</script'; ?>
>
<div class="row text-center head-title">
    <h1>守望者舆情监控&nbsp<small>v0.1</small></h1>
    <p>Yuri</p>
</div>


<div class="row center-block" style="width: 40%;">
    <form class="input-group" action="/watcher/country" method="get">
      <input name="topic" type="text" class="form-control nav-item-dark" placeholder="微博话题" tabindex="1">
      <span class="input-group-btn">
        <button class="btn btn-default nav-item-dark" tabindex="-1">搜索</button>
      </span>
    </form>
    <ul class="list-inline" style="margin-top: 10px;">
      <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['hotTopic']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
        <li><a class="label label-default" style="background-color: #222;color: #9d9d9d;" href="/watcher/country?topic=<?php echo $_smarty_tpl->tpl_vars['item']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</a></li>
      <?php } ?>
    </ul>
</div>

<div cl>

</div>


<div class="row text-center">
    <h4 id="chartTitle" style="z-index: 2;position: absolute; margin: 5% 0 0 47%;display: none;">实时情绪概况</h4>
</div>
<di class="row" style="z-index: 1;">
    <div class="center-block" id="wholeCountry" style="height: 500px;width: 50%;"></div>
</div>
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
                show: false,
                text: '实时情绪概况',
                subtext: '',
                x: 'center',
                y: '50',
                textStyle: {
                    fontSize: 25,
                    fontWeight: 'bolder',
                    color: '#9d9d9d'
                }
            },
            dataRange: {
                show: false,
                min: -100,
                max: 100,
                x: 1000,
                y: 'center',
                text: ['高', '低'], // 文本，默认为数值文本
                calculable: true,
                color: ['green', '#9d9d9d', 'red']
            },
            series: [{
                name: '测试数据',
                type: 'map',
                mapType: 'china',
                hoverable: false,
                dataRangeHoverLink: false,
                mapValueCalculation: 'average',
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
                    name: '山西',
                    value: 50
                },{
                    name: '福建',
                    value: -50
                },{
                    name: '四川',
                    value: 0
                }]
            }]
        };

        var chart = ec.init(document.getElementById('wholeCountry'));
        chart.setOption(option);

        $('#wholeCountry').mouseenter(function(){
            $('#chartTitle').stop(true).fadeIn("slow");
        }).mouseleave(function(){
            $('#chartTitle').stop(true).fadeOut("slow");
        });
    });
<?php echo '</script'; ?>
>




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
