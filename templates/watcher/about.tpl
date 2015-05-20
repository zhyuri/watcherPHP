{{* 关于页面 *}}
{{block name=content}}
<script type="text/javascript">
    $("ul.navbar-nav li[role!='about']").html('');{{*清除导航栏中原本的搜索框*}}
</script>

<div class="row">
    <div class="col-xs-6 col-xs-offset-3">
        <div class="text-center" style="margin-bottom: 50px;">
            <h1>致敬</h1>
        <small>感谢以下开源软件为本项目提供的帮助</small>
        </div>
        <ul class="list-unstyled center-block">
            <dl class="dl-horizontal">
              <dt><a href="http://www.ubuntu.com/">Linux</a></dt>
              <dd>选用Ubutu发行版部署测试环境</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt><a href="http://www.apache.org/">Apache</a></dt>
              <dd>由Apache/2.2.22提供服务</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt><a href="https://www.mysql.com/">MySQL</a></dt>
              <dd>由MySQL14.14版本提供数据库服务</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt><a href="http://php.net/">PHP</a></dt>
              <dd>选择PHP 5.4.36 版本</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt><a href="http://memcached.org/">Memcached</a></dt>
              <dd>高效的分布式缓存服务</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt><a href="http://www.smarty.net/">Smarty</a></dt>
              <dd>强大的模板引擎</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt><a href="https://jquery.com/">jQuery</a></dt>
              <dd>高速轻量并且功能强大的JavaScript库</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt><a href="http://getbootstrap.com/">Bootsrtrap</a></dt>
              <dd>简洁直观强悍的前端开发框架，让web开发更迅速简单</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt><a href="http://echarts.baidu.com/">ECharts</a></dt>
              <dd>百度Echarts库为本站图表提供全部动力</dd>
            </dl>
            <dl class="dl-horizontal">
              <dt><a href="https://github.com/MatrixYuri/Vera">Vera</a></dt>
              <dd>作者独立开发的轻量PHP框架</dd>
            </dl>
        </ul>
        <div class="text-center" style="margin-top: 50px;">
            <i>UI设计灵感来源于<a href="http://www.zoomeye.org/">ZoomEye</a></i>
        </div>
    </div>
</div>
{{/block}}
