{{extends file='layout/main.tpl'}}
{{* 全国转发情况 *}}
{{block name=content}}
<div class="row">
    <div class="center-block" id="repostMap" style="height: 650px;"></div>
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
        'echarts/chart/map'
    ],
    function(ec) {
        var option = {
            backgroundColor : '#131313',
            title: {
                show: true,
                text: '全国传播地图',
                subtext: '#{{$smarty.session.word}}#',
                x: 'right',
                y: 'top',
                textStyle: {
                    fontSize: 25,
                    fontWeight: 'bolder',
                    color: '#9d9d9d'
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
            series: [{
                name: "#{{$smarty.session.word}}#",
                type: 'map',
                mapType: 'china',
                hoverable: false,
                clickable: false,
                dataRangeHoverLink: false,
                mapValueCalculation: 'average',
                showLegendSymbol: true,
                roam: true,
                scaleLimit: {//放缩界限
                    max: 10,
                    min: 1
                },
                itemStyle: {
                    normal: {
                        borderColor: 'rgba(100,149,237,0.2)',
                        borderWidth: 0.5,
                        areaStyle: {
                            color: '#1b1b1b'
                        }
                    }
                },
                data: [{}],
                markPoint: {
                    clickable: true,
                    symbol: 'circle',
                    symbolSize: 1.5,
                    large: true,
                    effect: {
                        show: true,
                        type: 'scale',
                        loop: true,
                        period: 5,//运动周期，无单位，值越大越慢，默认为15
                        scaleSize: 5,//type为scale时有效
                        bounceDistance: 10,//跳动距离，单位为px，type为bounce时有效
                        color: null,
                        shadowColor: null,
                        shadowBlur: 0
                    },
                    itemStyle: {
                        normal: {
                            color: 'rgba(255, 0, 0, 0.5)'
                        }
                    },
                    data: []
                },
                markLine: {
                    clickable: false,
                    symbol: ['none', 'none'],
                    symbolSize: [2, 4],
                    large: true,
                    smooth: true,
                    smoothness: 0.1,
                    bundling: {
                        enable: true,
                        maxTurningAngle: 45
                    },
                    effect: {
                        show: true,
                        loop: true,
                        period: 15,
                        scaleSize : 2,
                        color : 'rgba(204, 246, 255, 0.09)',
                        shadowColor : null,
                        shadowBlur : null
                    },
                    itemStyle: {
                        normal: {
                            lineStyle: {
                                color: 'rgba(2, 166, 253, 0.05)',
                                type: 'solid',
                                width: 0.5,
                                opacity: 0.2
                            }
                        }
                    },
                    data: []
                }
            }]
        };

        var geoCoord = {{$coordData|default:array()|@json_encode}};

        var points = {{$pointData|default:array()|@json_encode}};
        option.series[0].markPoint.data = points.filter(function(point){
            return point.value > 0;
        }).map(function(point){
            return {
                geoCoord: geoCoord[point.name]
            }
        });

        var lines = {{$lineData|default:array()|@json_encode}};
        option.series[0].markLine.data = lines.filter(function(line){
            return line[0].value > 10;
        }).map(function(line){
            return [{
                geoCoord: geoCoord[line[0].name]
            }, {
                geoCoord: geoCoord[line[1].name]
            }]
        });

        var chart = ec.init(document.getElementById('repostMap'));
        chart.setOption(option);
    }
)
</script>
{{/block}}
