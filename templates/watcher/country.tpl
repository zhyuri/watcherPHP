{{* 全国情感趋势图 *}}
{{block name=content}}

<span class="label label-default">转发数: 2000</span>
<span class="label label-default">参与用户: 2000</span>
<div class="row">
    <div class="center-block" id="moodTimeline" style="height: 600px;"></div>
</div>

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
            timeline: {
                data: [],
                // label: {
                //     formatter: function(s) {
                //         return s.slice(0, 4);
                //     }
                // },
                autoPlay: true,
                playInterval: 1000
            },
            options: [{
                title: {
                    'text': '2002全国宏观经济指标',
                    'subtext': '数据来自国家统计局'
                },
                tooltip: {
                    'trigger': 'item'
                },
                toolbox: {
                    'show': true,
                    'feature': {
                        'mark': {
                            'show': true
                        },
                        'dataView': {
                            'show': true,
                            'readOnly': false
                        },
                        'restore': {
                            'show': true
                        },
                        'saveAsImage': {
                            'show': true
                        }
                    }
                },
                dataRange: {
                    min: 0,
                    max: 53000,
                    text: ['高', '低'], // 文本，默认为数值文本
                    calculable: true,
                    x: 'left',
                    color: ['orangered', 'yellow', 'lightskyblue']
                },
                series: [{
                    'name': 'GDP',
                    'type': 'map',
                    'data': dataMap.dataGDP['2002']
                }]
            }]
        };
    }
)
</script>







{{/block}}
