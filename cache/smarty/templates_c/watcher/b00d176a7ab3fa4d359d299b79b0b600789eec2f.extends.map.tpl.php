<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-05-09 16:45:29
         compiled from "/Users/zhangyuri/站点/templates/watcher/map.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2077380537554d6f96b19fc1-77899511%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ee65b2b94e0dd453230f14974c603d8846980cd' => 
    array (
      0 => '/Users/zhangyuri/站点/templates/watcher/map.tpl',
      1 => 1431140711,
      2 => 'file',
    ),
    '418ca0cdb5395caaf4c3a97b14af2205ffb5641e' => 
    array (
      0 => '/Users/zhangyuri/站点/templates/watcher/layout/main.tpl',
      1 => 1431161108,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2077380537554d6f96b19fc1-77899511',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_554d6f96b46547_84773461',
  'variables' => 
  array (
    'title' => 0,
    'base' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_554d6f96b46547_84773461')) {function content_554d6f96b46547_84773461($_smarty_tpl) {?><!DOCTYPE html>
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
            <li><a href="/watcher/user" tabindex="-1">传播用户</a></li>
            <li><a href="/watcher/map" tabindex="-1">传播地图</a></li>
            <li><a href="/watcher/country" tabindex="-1">情绪趋势</a></li>
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

    


</div>

<footer class="stick-bottom">
  <div class="container">
    <hr style="border-color: #666666;">
    <p class="text-center">Designed and built with all the love in the world by <a href="http://weibo.com/u/2177378587" target="_blank" tabindex="-1">Yuri</a> at <a href="http://www.xmu.edu.cn" target="_blank" tabindex="-1">XMU</a></p>
    <p class="text-center">©<a href="http://blog.yurilab.com" target="_blank" tabindex="-1">yuriLab</a> 2015.All rights reserved.</p>
  </div>
</footer>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['base']->value;?>
watcher/static/js/bootstrap.min.js"><?php echo '</script'; ?>
>

</body>
</html>
<?php }} ?>
