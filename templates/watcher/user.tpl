{{* 用户传播图 *}}
{{block name=content}}
<div class="row">
    <div class="center-block" id="userForce" style="height: 650px;"></div>
</div>

<script type="text/javascript">
require.config({
    paths: {
        echarts: '{{$base}}watcher/static/js/echarts'
    }
});

require(
    [
        'echarts',
        'echarts/chart/force'
    ],
    function(ec) {
        var option = {
            backgroundColor : '#131313',
            title: {
                show: true,
                text: '用户传播拓扑',
                subtext: '#{{$smarty.session.word}}#',
                x: 'right',
                y: 'top',
                textStyle: {
                    fontSize: 25,
                    fontWeight: 'bolder',
                    color: '#9d9d9d'
                }
            },
            tooltip: {
                trigger: 'item',
                transitionDuration: 0,
                formatter: function(param){
                    var data = param.data;
                    if ( data.source == null || data.target == null ) {
                        return '转发量:'+data.value;
                    }
                    return '';
                }
            },
            toolbox: {
                show: true,
                orient: 'vertical',
                x: 'right',
                y: 'center',
                itemSize: 20,
                color: ['#0af'],
                feature: {
                    restore : {
                        show : true,
                        title : '复位'
                    },
                    saveAsImage : {
                        show : true,
                        title : '截图保存',
                        name : '用户传播拓扑图#{{$smarty.session.word}}#',
                        type : 'png',
                        lang : ['点击下载']
                    }
                }
            },
            legend: {
                x: 'right',
                y: 80,
                orient: 'vertical',
                data: ['普通用户', '个人认证', '机构认证'],
                textStyle: {
                    color: '#9d9d9d'
                }
            },
            series: [{
                type: 'force',
                name: "#{{$smarty.session.word}}#",
                itemStyle: {
                    normal: {
                        label: {
                            show: true,
                            textStyle: {
                                color: 'white'
                            }
                        },
                        nodeStyle: {
                            color: '#333',
                            borderColor: 'rgba(255,215,0,0.4)',
                            borderWidth: 1
                        },
                        linkStyle: {}
                    },
                    emphasis: {
                        label: {
                            show: false
                        },
                        nodeStyle: {},
                        linkStyle: {}
                    }
                },
                minRadius: 10,//node分布最小半径
                maxRadius: 11,
                gravity: 1.5,
                scaling: 1.5,
                draggable: true,
                linkSymbol: 'arrow',
                large: false,
                useWorker: true,
                steps: 50,
                roam: false,
                categories: [{
                    name: '普通用户',
                    symbol: 'circle',
                    symbolSize: 10,
                    itemStyle: {
                        normal : {
                            color: 'white',
                            borderWidth: 2,
                            borderColor: '#9d9d9d'
                        }
                    }
                },{
                    name: '个人认证',
                    symbol: 'circle',
                    symbolSize: 30,
                    itemStyle: {
                        normal : {
                            color: 'rgb(245,175,39)',
                            borderWidth: 2,
                            borderColor: '#9d9d9d'
                        }
                    }
                },{
                    name: '机构认证',
                    symbol: 'circle',
                    symbolSize: 40,
                    itemStyle: {
                        normal : {
                            color: 'rgb(63,160,244)',
                            borderWidth: 2,
                            borderColor: '#9d9d9d'
                        }
                    }
                }],
                nodes: {{$nodes|default:array()|@json_encode}},
                links: {{$links|default:array()|@json_encode}}
            }]
        };
        var chart = ec.init(document.getElementById('userForce'));
        var ecConfig = require('echarts/config');

        chart.on(ecConfig.EVENT.CLICK, function(param){
            var data = param.data;
            if ( data.source == null || data.target == null ) { // 点击的是点
                console.log("选中了" + data.name + '(' + data.value + ')');
                var series = chart.getSeries();
                for(i in series[0].nodes){
                    if (series[0].nodes[i].name == data.name) {
                        series[0].nodes[i].ignore = true;
                    };
                }
                chart.setSeries(series, true);
            }
        });

        chart.on(ecConfig.EVENT.RESTORE, function(param){
            var series = chart.getSeries();
            for(i in series[0].nodes){
                    series[0].nodes[i].ignore = false;
            }
            chart.setSeries(series, true);
        });

        chart.setOption(option);
    }
)
</script>

{{/block}}
