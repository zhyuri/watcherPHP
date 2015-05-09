{{* 首页 *}}
{{block name=content}}
<script type="text/javascript">
    $("ul.navbar-right li[role='search']").html('');//清除导航栏中原本的搜索框
</script>
<div class="row text-center head-title">
    <h1>守望者舆情监控系统&nbsp<small>Beta</small></h1>
    <p>Yuri</p>
</div>
{{* 搜索框 *}}
<div class="row center-block" style="width: 40%;height: 50px;">
    <form class="input-group" action="/watcher/country" method="post">
      <input name="topic" type="text" class="form-control nav-item-dark" placeholder="Search" tabindex="1">
      <span class="input-group-btn">
        <button class="btn btn-default nav-item-dark" tabindex="-1">搜索</button>
      </span>
    </form>
</div>
{{* 全国整体情绪展示 *}}
<div id="wholeCountry" style="height: 550px;"></div>
<script type="text/javascript">
require.config({
    paths: {
        echarts: '.{{$base}}watcher/static/js/echarts'
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
</script>
{{/block}}
