{{extends file='layout/main.tpl'}}
{{* 全国情感趋势图 *}}
{{block name=content}}
<div class="row">
    <div class="center-block" id="moodTimeline" style="height: 650px;"></div>
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
        var _optionTpl = {
            backgroundColor : '#131313',
            title: {
                show: true,
                text: '全国舆情发展状况',
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
                        name : '全国舆情发展状况#{{$smarty.session.word}}#',
                        type : 'png',
                        lang : ['点击下载']
                    }
                }
            },
            tooltip: {
                trigger: 'axis',
                show: true,
                showDelay: 0,
                hideDelay: 50,
                transitionDuration: 0,
                backgroundColor: 'rgba(255,0,255,0.7)',
                borderColor: '#f50',
                borderRadius: 8,
                borderWidth: 2,
                padding: 10,
                position: function(p) {
                    return [p[0] + 10, p[1] - 10];
                },
                textStyle: {
                    color: 'yellow',
                    decoration: 'none',
                    fontFamily: 'Microsoft YaHei',
                    fontSize: 15,
                    fontWeight: 'lighter'
                }
            },
            dataRange: {
                show: false,
                min: -100,
                max: 100,
                orient: 'horizontal',
                x: 'center',
                y: 'bottom',
                padding: [15, 0, 0, 0],
                itemWidth: 30,
                text: ['正面', '负面'],
                calculable: true,
                color: ['green', '#9d9d9d', 'red'],
                textStyle: {
                    color: '#9d9d9d'
                }
            },
            series: []
        }
        var option = {
            timeline: {
                notMerge: true,
                data: ['{{$labels}}'],
                lineStyle: {
                    color: '#666',
                    width: 2,
                    type: 'dashed'
                },
                label: {
                    textStyle: {
                        color: '#9d9d9d'
                    }
                },
                checkpointStyle: {
                    color: 'red'
                },
                symbol: 'emptyCircle',
                symbolSize: 6,
                currentIndex: 0,
                autoPlay: true,
                playInterval: 1000
            },
            options: []
        };

        var data = {{$data|@json_encode}};
        for (i in data) {
            option.options.push($.extend({}, _optionTpl, {series: [data[i]]}));
        }

        var chart = ec.init(document.getElementById('moodTimeline'));
        chart.setOption(option);
    }
)
</script>
{{/block}}
